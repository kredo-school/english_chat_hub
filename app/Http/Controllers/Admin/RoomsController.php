<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
    private $room;
    private $meeting;
    public function __construct(Room $room, Meeting $meeting)
    {
        $this->room = $room;
        $this->meeting = $meeting;
    }
    public function index()
    {
        $all_rooms = $this->room->withTrashed()->latest()->get();
        return view('admin.chatrooms.rooms.index')
            ->with('all_rooms', $all_rooms);
    }
    public function show($id)
    {
        // update Meetings Status
        $this->meeting->updateStatus();

        $room = $this->room->withTrashed()->findOrFail($id);
        $meetings = $room->meetings()->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.rooms.show')
            ->with('room', $room)
            ->with('meetings', $meetings)
            ->with('statusColor', $this->meeting->statusColor());
    }
    public function delete($id)
    {
        $room = $this->room->findOrFail($id);
        foreach ($room->meetings as $meeting) {
            $meeting->delete();
        }
        $room->delete();
        return redirect()->route('admin.chatroom.room.index');
    }
    public function restore($id)
    {
        $room = $this->room->withTrashed()->findOrFail($id);
        $room->restore();
        return redirect()->route('admin.chatroom.room.index');
    }
}
