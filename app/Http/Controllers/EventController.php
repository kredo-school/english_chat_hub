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
        return view('users.event')
        ->with('all_events' , $all_events);
    }

    public function show(Event $event){
        return view ('users.event_detail')
        ->with('event', $event);
    }

    public function joinForm(){
        return view('users.event_join_form');
    }


}
