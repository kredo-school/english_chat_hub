<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;
use App\Models\Level;
use App\Models\Category;
use App\Models\Room;

class MeetingController extends Controller
{
    public function __construct(Level $level, Category $category, Meeting $meeting, Room $room){
        $this->level = $level;
        $this->category = $category;
        $this->meeting = $meeting;
        $this->room = $room;
    }

    public function create(){
        $all_levels = $this->level->all();
        $all_categories = $this->category->all();
        $all_rooms = $this->room->all();

        return view('users.research.create_meeting')
        ->with('all_levels', $all_levels)
        ->with('all_categories', $all_categories)
        ->with('all_rooms', $all_rooms);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:50',
            'date' =>'required|date',
            'start_at' => 'required',
            'room_id' => 'required',
            'level_id' => 'required',
            'category_id' => 'required'
        ]);

        $this->meeting->user_id = Auth::user()->id;
        $this->meeting->title = $request->title;
        $this->meeting->date = $request->date;
        $this->meeting->start_at = $request->start_at;
        $this->meeting->room_id = $request->room_id;
        $this->meeting->level_id = $request->level_id;
        $this->meeting->category_id = $request->category_id;
        $this->meeting->save();
        return redirect()->route('users.top');
    }
}
