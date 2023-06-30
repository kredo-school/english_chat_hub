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
    public function create(){
        $all_levels = Level::all();
        $all_categories = Category::all();
        $all_rooms = Room::all();
        
        return view('users.research.create_meeting')
        ->with('all_levels', $all_levels)
        ->with('all_categories', $all_categories)
        ->with('all_rooms', $all_rooms);
    }

    public function store(Request $request){
        $request->validate([
            'title'        => 'required|max:50',
            'date'         =>'required|date',
            'start_at'     => 'required',
            'room_id'      => 'required',
            'level_id'     => 'required',
            'category_id'  => 'required'
        ]);

        Meeting::create([
            'user_id'      => auth()->user()->id,
            'title'        => $request->title,
            'date'         => $request->date,
            'start_at'     => $request->start_at,
            'room_id'      => $request->room_id,
            'level_id'     => $request->level_id,
            'category_id'  => $request->category_id
       ]);
        return redirect()->route('users.top');
    }

    public function edit(Meeting $meeting){
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

    public function update(Request $request, $id){
        $request->validate([
            'title'         => 'required|max:50',
            'room_id'       => 'required',
            'category_id'   => 'required',
            'level_id'      => 'required',
            'date'          => 'required|date',
            'start_at'      => 'required|integer|max:24'
        ]);

        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->title         = $request->title;
        $meeting->room_id       = $request->room_id;
        $meeting->category_id   = $request->category_id;
        $meeting->level_id      = $request->level_id;
        $meeting->date          = $request->date;
        $meeting->start_at      = date('H:i:s', strtotime($request->start_at . ':00:00'));
        $meeting->save();

        return redirect()->route('users.reserved.show.details');
    }

    public function delete(Meeting $meeting){
        $meeting->forceDelete();
        return redirect()->back();
    }

    public function cancel(Meeting $meeting){
        $user = Auth::user();
        $user->joinMeetings()->detach($meeting->id);
        return redirect()->back();
    }

}
