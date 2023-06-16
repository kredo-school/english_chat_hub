<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Level;
use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingsController extends Controller
{
    const DEFAULT_STATUS_ID = 1;
    public function index(Meeting $meeting)
    {
        // update Meetings Status
        $meeting->updateStatus();
        $all_meetings = $meeting->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.meetings.index')
            ->with('all_meetings', $all_meetings)
            ->with('statusColor', $meeting->statusColor());
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|min:5|max:20',
            'room_id'       => 'required',
            'category_id'   => 'required',
            'level_id'      => 'required',
            'date'          => 'required|date|after_or_equal:today',
            'start_at'      => 'required'
        ]);
        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->title         = $request->title;
        $meeting->room_id       = $request->room_id;
        $meeting->category_id   = $request->category_id;
        $meeting->level_id      = $request->level_id;
        $meeting->date          = $request->date;
        $meeting->start_at      = $request->start_at;
        $meeting->status_id     = self::DEFAULT_STATUS_ID;
        $meeting->save();
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
        $meeting->status_id = self::DEFAULT_STATUS_ID;
        $meeting->save();
        $meeting->restore();
        return redirect()->route('admin.chatrooms.meetings.index');
    }
}
