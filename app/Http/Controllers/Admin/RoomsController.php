<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ZoomController;

class RoomsController extends Controller
{
    public function index()
    {
        $all_rooms = Room::withTrashed()->paginate(10);
        return view('admin.chatrooms.rooms.index')
            ->with('all_rooms', $all_rooms);
    }
    public function show($id, Meeting $meeting)
    {
        // update Meetings Status
        Meeting::updateStatus();

        $room = Room::withTrashed()->findOrFail($id);
        $meetings = $room->meetings()->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.rooms.show')
            ->with('room', $room)
            ->with('meetings', $meetings)
            ->with('statusColor', Meeting::statusColor());
    }
    public function delete(Room $room)
    {
        foreach ($room->meetings as $meeting) {
            $meeting->zoomMeeting()->delete();
        }
        $room->meetings()->delete();
        $room->delete();
        return redirect()->route('admin.chatrooms.rooms.index');
    }
    public function restore($id)
    {
        Room::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.chatrooms.rooms.index');
    }

    public function deleteZoomAccount($id, ZoomController $z) {
        $room = Room::withTrashed()->findOrFail($id);
        if ($room->zoomAccount) {
            foreach ($room->meetings as $meeting) {
                if ($meeting->zoomMeeting) {
                    $z->deleteZoomMeeting($meeting);
                    $meeting->zoomMeeting()->delete();
                }
            }
            $room->meetings()->delete();
            $room->zoomAccount()->forceDelete();
            $room->delete();
        }
        return redirect()->route('admin.chatrooms.rooms.index');
    }
}
