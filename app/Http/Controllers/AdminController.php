<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    private $user;
    private $event;
    private $level;

    const LOCAL_STORAGE_FOLDER = '/public/images/';

    public function __construct(User $user, Event $event, Level $level)
    {
        $this->user = $user;
        $this->event = $event;
        $this->level = $level;

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

    public function storeEvent(Request $request)
    {
        $request->validate([
            'theme' => 'required|min:1|max:255',
            'comment' => 'required|min:1|max:255',
            'location' => 'required|min:1|max:255',
            'date' => 'required',
        ]);

        $this->event->theme = $request->theme;
        $this->event->comment = $request->comment;
        $this->event->location = $request->location;
        $this->event->date = $request->date;
        $this->event->image = $this->saveImage($request);

        $this->event->save();

        foreach($request->level as $level) {
            $this->event->eventLevels()->attach($level);
        }

        return redirect()->route('admin.showEvents');
    }

    public function saveImage($request)
    {
        $image_name = time().".". $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name);
        return $image_name;

    }
}
