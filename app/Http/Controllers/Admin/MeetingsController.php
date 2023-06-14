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
    private $meeting;
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
        $this->meeting->updateStatus();
    }
    public function index()
    {
        $all_meetings = $this->meeting->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.meetings.index')
            ->with('all_meetings', $all_meetings)
            ->with('statusColor', $this->meeting->statusColor());
    }
    public function edit($id)
    {
        $all_categories = Category::all();
        $all_rooms = Room::all();
        $all_levels = Level::all();
        $meeting = $this->meeting->withTrashed()->findOrFail($id);
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
        $meeting = $this->meeting->findOrFail($id);
        $meeting->title         = $request->title;
        $meeting->room_id       = $request->room_id;
        $meeting->category_id   = $request->category_id;
        $meeting->level_id      = $request->level_id;
        $meeting->date          = $request->date;
        $meeting->start_at      = $request->start_at;
        $meeting->status_id     = 1;
        $meeting->save();
        return redirect()->route('admin.chatroom.meeting.index');
    }
    public function delete($id)
    {
        $this->meeting->findOrFail($id)->delete();
        return redirect()->route('admin.chatroom.meeting.index');
    }
    public function restore($id)
    {
        $meeting = $this->meeting->withTrashed()->findOrFail($id);
        $meeting->status_id = 1;
        $meeting->save();
        $meeting->restore();
        return redirect()->route('admin.chatroom.meeting.index');
    }
}
