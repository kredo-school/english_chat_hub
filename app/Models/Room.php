<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    // RELATION
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
    public function zoomAccount() {
        return $this->hasOne(Zoom_account::class);
    }

    public function zoomOauthLink()
    {
        $zoomOuthLink = 'https://zoom.us/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'redirect_uri'  => env('APP_URL') . '/zoomoauth/check/' . $this->id . '/',
            'client_id'     => env('ZOOM_CLIENT_ID'),
        ]);
        return $zoomOuthLink;
    }
}
