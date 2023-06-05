<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class AdminController extends Controller
{
    private $user;
    private $event;

    public function __construct(User $user, Event $event)
    {
        $this->user = $user;
        $this->event = $event;

    }

    // Users
    public function showUsers()
    {
        $all_users = $this->user->all();
        return view('admin.users.allusers')->with('all_users',$all_users);
    }

    // Events
    public function showEvents()
    {
        $all_events = $this->event->all();
        return view('admin.events.index')->with('all_events',$all_events);
    }

    public function createEvent()
    {
        return view('admin.events.create');
    }
}
