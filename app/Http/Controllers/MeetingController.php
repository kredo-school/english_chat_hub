<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Level;
use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function store(Request $request, ZoomController $z)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:50',
            'category_id'   => 'required',
            'level_id'      => 'required',
            'room_id'       => 'required',
            'date'          => 'required|after_or_equal:today',
            'start_at'      => 'required'
        ]);

        $meeting = new Meeting;
        $meeting->title         = $request->title;
        $meeting->user_id       = Auth::user()->id;
        $meeting->category_id   = $request->category_id;
        $meeting->room_id       = $request->room_id;
        $meeting->level_id      = $request->level_id;
        $meeting->date          = $request->date;
        $meeting->start_at      = $request->start_at;

        $meeting->save();
        $meeting->joinMeetings()->attach(Auth::user()->id);

        // Create Zoom Meeting
        if ($meeting->room->zoomAccount) {
            $z->createZoomMeeting($meeting);
        }

        return redirect()->back();
    }

    public function edit(Meeting $meeting)
    {
        $meeting->user_id  = Auth::user()->id;
        $all_categories    = Category::all();
        $all_rooms         = Room::all();
        $all_levels        = Level::all();
        return view('users.reserved.edit')
            ->with('meeting', $meeting)
            ->with('all_categories', $all_categories)
            ->with('all_rooms', $all_rooms)
            ->with('all_levels', $all_levels);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|max:50',
            'category_id'   => 'required',
            'level_id'      => 'required',
        ]);

        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->title         = $request->title;
        $meeting->category_id   = $request->category_id;
        $meeting->level_id      = $request->level_id;
        $meeting->save();

        return redirect()->route('users.reserved.show.details');
    }

    // public function delete(Meeting $meeting){

    public function delete(Meeting $meeting, ZoomController $z)
    {
        // Delete Zoom Meeting
        if ($meeting->zoomMeeting) {
            $z->deleteZoomMeeting($meeting);
            $meeting->zoomMeeting()->delete();
        }

        $meeting->forceDelete();

        return redirect()->back();
    }

    public function cancel(Meeting $meeting)
    {
        $user = Auth::user();
        $user->joinMeetings()->detach($meeting->id);
        return redirect()->back();
    }

    public function join(Meeting $meeting)
    {
        $user = Auth::user();
        $user->joinMeetings()->attach($meeting->id);
        return redirect()->route('users.top');
    }

    public function result($date)
    {
        $all_meetings       = Meeting::all();
        $all_rooms          = Room::all();
        $all_levels         = Level::all();
        $all_categories     = Category::all();
        $result = date('Y-m-d', strtotime($date));
        $timeTable = [];
        $now = Carbon::parse('10:00:00');
        for ($i = 0, $time = intval($now->hour); $i < 15, $time <= 23; $i++, $time++) {
            $timeTable[$i] = [
                date('G:00', strtotime($now->copy()->addHours($i))), date('G:00', strtotime($now->copy()->addHours($i + 1)))
            ];
        }
        return view('users.meetings.result')
            ->with('date', $result)
            ->with('timeTable', $timeTable)
            ->with('all_rooms', $all_rooms)
            ->with('all_meetings', $all_meetings)
            ->with('all_levels', $all_levels)
            ->with('all_categories', $all_categories)
            ->with('user', Auth::user());
    }
}
