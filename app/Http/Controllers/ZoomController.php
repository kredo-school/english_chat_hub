<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use GuzzleHttp\Client;
use App\Models\Meeting;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Type\MixedType;

class ZoomController extends Controller
{
    public function zoomOauthLink(Room $room)
    {
        $zoomOuthLink = 'https://zoom.us/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'redirect_uri'  => env('APP_URL') . '/zoomoauth/check/' . $room->id . '/',
            'client_id'     => env('ZOOM_CLIENT_ID'),
        ]);
        return redirect()->away($zoomOuthLink);
    }

    public function zoomOauth(Request $request, Room $room)
    {
        if ($room->zoomAccount == null) {
            $code   = $request['code'];
            $basic = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));

            // Request
            $client = new Client([
                'headers' => ['Authorization' => 'Basic ' . $basic],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]);
            $res = $client->request('POST', 'https://zoom.us/oauth/token', [
                'query' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => env('APP_URL') . '/zoomoauth/check/' . $room->id . '/'
                ]
            ]);

            $result = json_decode($res->getBody()->getContents());

            // Store into Zoom_accounts 
            $accountInfo    = $this->me($result->access_token);
            $unixTime       = time();
            $accountProps   = [
                'name'            => $accountInfo->first_name . ' ' . $accountInfo->last_name,
                'email'           => $accountInfo->email,
                'zoom_code'       => $code,
                'access_token'    => $result->access_token,
                'refresh_token'   => $result->refresh_token,
                'zoom_expires_in' => date("Y-m-d H:i:s", $unixTime + $result->expires_in),
            ];
            $room->zoomAccount()->create($accountProps);

            return redirect()->route('admin.chatrooms.rooms.show', $room->id);
        } else {
            return redirect()->back();
        }
    }

    protected function me($token)
    {
        $client = new Client([
            'headers' => ['Authorization' => 'Bearer ' . $token]
        ]);
        $res = $client->request('GET', 'https://api.zoom.us/v2/users/me');

        $result = json_decode($res->getBody()->getContents());

        return $result;
    }

    protected function checkRefresh(Room $room)
    {
        $token_expires =  Carbon::parse($room->zoomAccount->zoom_expires_in);
        
        if (now() >= $token_expires) {
            $basic = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            
            // Request refreshToken
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Basic ' . $basic,
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
            $res = $client->request('POST', 'https://zoom.us/oauth/token', [
                'query' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $room->zoomAccount->refresh_token
                ]
            ]);

            $result = json_decode($res->getBody()->getContents());

            // Update zoom_account
            $unixTime = time();
            $room->zoomAccount->access_token = $result->access_token;
            $room->zoomAccount->refresh_token = $result->access_token;
            $room->zoomAccount->zoom_expires_in = date("Y-m-d H:i:s", $unixTime + $result->expires_in);
            $room->zoomAccount->save();
        }
        return $room;
    }

    public function createZoomMeeting(Meeting $meeting)
    {
        // Check Token
        $room = $this->checkRefresh($meeting->room);

        // for Request
        $zoom_user          = $this->me($room->zoomAccount->access_token);
        $url                = 'https://api.zoom.us/v2/users/' . $zoom_user->id . '/meetings';
        $startAt            = date('Y-m-d\TH:m:s', strtotime($meeting->date . $meeting->start_at));
        $meeting_password   = substr(base_convert(bin2hex(openssl_random_pseudo_bytes(9)), 16, 36), 0, 9);
        $topic              = 'user_' . $meeting->user->id .'-'. $meeting->user->user_name . '_' . $meeting->id;

        // Request
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $room->zoomAccount->access_token,
                'Content-Type' => 'application/json'
            ],
        ]);
        $res = $client->request('POST', $url, [
            RequestOptions::JSON => [
                'topic'         => $topic,
                'type'          => 2,
                'timezone'      => 'Asia/Tokyo',
                'start_time'    => $startAt,
                'password'      => $meeting_password
            ]
        ]);

        $result = json_decode($res->getBody()->getContents());

        // Store into zoom_meetings table
        $meeting->zoomMeeting()->create([
            'zoom_meeting_id' => $result->id,
            'zoom_join_url'   => $result->join_url,
            'zoom_start_url'  => $result->start_url,
            'zoom_password'   => $result->password,
        ]);
    }

    public function deleteZoomMeeting(Meeting $meeting)
    {
        // Check token
        $room = $this->checkRefresh($meeting->room);

        // for Request
        $url = 'https://api.zoom.us/v2/meetings/' . $meeting->zoomMeeting->zoom_meeting_id;

        // Request
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $room->zoomAccount->access_token,
                'Content-Type'  => 'application/json'
            ],
        ]);
        $res = $client->request('DELETE', $url);

        // $result = json_decode($res->getBody()->getContents());
        // dd($result);
    }
    public function editZoomMeeting(Meeting $meeting)
    {
        // Check token
        $room = $this->checkRefresh($meeting->room);

        // for Request
        $url        = 'https://api.zoom.us/v2/meetings/' . $meeting->zoomMeeting->zoom_meeting_id;
        $startAt    = date('Y-m-d\TH:m:s', strtotime($meeting->date . $meeting->start_at));

        // Request
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $room->zoomAccount->access_token,
                'Content-Type'  => 'application/json'
            ],
        ]);
        $res = $client->request('PATCH', $url, [
            RequestOptions::JSON => [
                'topic'         => $meeting->user->user_name . '_ID:' . $meeting->id,
                'type'          => 2,
                'timezone'      => 'Asia/Tokyo',
                'start_time'    => $startAt
            ]
        ]);

        // $result = json_decode($res->getBody()->getContents());
        // dd($result);
    }
}
