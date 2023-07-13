<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Level;
use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ZoomController;

class MeetingsController extends Controller
{
    public function index(Meeting $meeting)
    {
        // update Meetings Status
        Meeting::updateStatus();
        $all_meetings = $meeting->withTrashed()->paginate(10);
        return view('admin.chatrooms.meetings.index')
            ->with('all_meetings', $all_meetings)
            ->with('statusColor', Meeting::statusColor());
    }
    public function edit($id)
    {
        $meeting        = Meeting::withTrashed()->findOrFail($id);
        $all_categories = Category::all();
        $all_rooms      = Room::all();
        $all_levels     = Level::all();
        return view('admin.chatrooms.meetings.edit')
            ->with('meeting', $meeting)
            ->with('all_categories', $all_categories)
            ->with('all_rooms', $all_rooms)
            ->with('all_levels', $all_levels);
    }
    public function update(Request $request, $id, ZoomController $z)
    {
        $request->validate([
            'title'         => 'required|min:5|max:20',
            'room_id'       => 'required',
            'category_id'   => 'required',
            'level_id'      => 'required',
            'date'          => 'required|date|after_or_equal:today',
            'start_at'      => 'required|integer|min:0|max:24'
        ]);
        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->title         = $request->title;
        $meeting->room_id       = $request->room_id;
        $meeting->category_id   = $request->category_id;
        $meeting->level_id      = $request->level_id;
        $meeting->date          = $request->date;
        $meeting->start_at      = date('H:i:s', strtotime($request->start_at . ':00:00'));
        $meeting->status_id     = Meeting::STATUS['stand_by']['id'];
        $meeting->save();

        if ($meeting->zoomMeeting) {
            $z->editZoomMeeting($meeting);
        }

        return redirect()->route('admin.chatrooms.meetings.index');
    }
    public function delete(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('admin.chatrooms.meetings.index');
    }
    public function restore($id)
    {
        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->status_id = Meeting::STATUS['stand_by']['id'];
        $meeting->save();
        $meeting->restore();
        return redirect()->route('admin.chatrooms.meetings.index');
    }

    public function forceDelete($id, ZoomController $z) {
        $meeting = Meeting::withTrashed()->findOrFail($id);

        if ($meeting->zoomMeeting) {
            $z->deleteZoomMeeting($meeting);
        }

        $meeting->forceDelete();
        return redirect()->route('admin.chatrooms.meetings.index');
    }
}
