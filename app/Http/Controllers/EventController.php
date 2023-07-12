<?php

namespace App\Http\Controllers;

use  Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $filtered_events = Event::all()->filter(function ($event) {
                $eventDate = strtotime($event->date);
                $todayDate = strtotime(date('Y-m-d'));
                return $eventDate >= $todayDate && $event->joinEvents->count() < $event->participants_limit;
            })->sortBy('date')->chunk(3);

        return view('users.events.index')
            ->with('filtered_events', $filtered_events);
    }

    public function show(Event $event)
    {
        $isJoined = null;
        if(auth()->check()){
            if ($participant = Participant::where('email', Auth::user()->email)->first()) {
                $isJoined = $participant->joinEvents()->where('event_id', $event->id)->first();
            }    
        }
        return view('users.events.event_detail')
            ->with('event', $event)
            ->with('isJoined', $isJoined);
    }

    public function joinForm($event_id)
    {
        return view('users.events.event_join_form')
            ->with('event_id', $event_id);
    }

    public function storeGuest(Request $request, $event_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        // check whether email exist in the participant table or not(participant use where and search)
        $participant = Participant::where('email', $request->email)->first();
        // check whether participant exist in the participant table or not
        if (!$participant) {
            $participant = new Participant;
            $participant->name = $request->name;
            $participant->email = $request->email;
            $participant->save();
        }
        // check whether participant is already in the join_event table and if not add join_events 
        if (!$participant->joinEvents()->where('event_id', $event_id)->first()) {
            $participant->joinEvents()->attach($event_id);
        }
        // session()
        $request->session()->flash('success', true);
        return redirect()->route('events.show', $event_id);
    }

    public function storeAuth($event_id, Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $participant = Participant::where('email', $user->email)->first();
    
            if (!$participant) {
                $participant = new Participant;
                $participant->name = $user->user_name;
                $participant->email = $user->email;
                $participant->isUser = true;
                $participant->user_id = $user->id; // ユーザーの user_id を格納
                $participant->save();
            }
        }
        // add join_events
        $participant->joinEvents()->attach($event_id);
        // session()
        $request->session()->flash('success', true);
        return redirect()->back();
    }

    public function destroyAuthParticipant($event_id)
    {
        $participant = Participant::where('email', Auth::user()->email)->first();
        $participant->joinEvents()->where('event_id', $event_id)->detach();
        return redirect()->route('events.show', $event_id);

    }
  
    public function cancel(Event $event)
    {
        $participant = Participant::where('email', Auth::user()->email)->first();
        $participant->joinEvents()->detach($event->id);
        return redirect()->back();
    }

}
