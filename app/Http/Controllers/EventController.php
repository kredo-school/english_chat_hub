<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\Level;

class EventController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $event;
    private $level;

    

    public function __construct(Event $event, Level $level){
        $this->event = $event;
        $this->level = $level;
    }

    public function show(){
        $all_events = $this->event->all();

        return view('users.event')
        ->with('all_events' , $all_events);
    }

    public function showDetail($id){
        $event = $this->event->findOrFail($id);
        return view ('users.event_detail')
        ->with('event', $event);
    }

}
