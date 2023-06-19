<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\Level;
use App\Models\Participant;

class EventController extends Controller
{

    public function index(){
        $all_events = Event::all();
        // dd($all_events[1]->levels()->count());
        return view('users.event')
        ->with('all_events' , $all_events);
    }

    public function show(Event $event){
        return view ('users.event_detail')
        ->with('event', $event);
    }

    // public function joinForm(Event $event, Participant $participant){
    public function joinForm(){
        // $all_events = Event::all();
        // $participant = Participant::all();
        // dd($all_events);
        return view('users.event_join_form');
        // ->with('all_events', $all_events)
        // ->with('participant', $participant);
    }


}
