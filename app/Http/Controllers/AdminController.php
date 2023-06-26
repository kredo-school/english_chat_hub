<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Contact;
use App\Models\Participant;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

 
    private $event;
   
    const LOCAL_STORAGE_FOLDER = '/public/images/';

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    // Users
    public function showUsers()
    {
        $all_users = User::withTrashed()->latest()->get();
        
        if ($all_users->isNotEmpty()) {
            return view('admin.users.allusers')->with('all_users', $all_users);
        }
    }
    public function deactivate($id)
    {
        User::destroy($id);
        return redirect()->back();
    }

    public function activate($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    // Events
    public function showEvents()
    {
        $all_events = Event::all();
        return view('admin.events.index')->with('all_events',$all_events);
    }

    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'theme' => 'required|max:255',
            'comment' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required',
        ]);

        $this->event->theme = $request->theme;
        $this->event->comment = $request->comment;
        $this->event->location = $request->location;
        $this->event->date = $request->date;
        $this->event->image = $this->saveImage($request);

        $this->event->save();

        foreach($request->level as $level) {
            $this->event->levels()->attach($level);
        }

        return redirect()->route('admin.showEvents');
    }

    public function saveImage($request)
    {
        $image_name = time().".". $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name);
        return $image_name;

    }
    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER.$image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function editEvent(Event $event)
    {
        $eventLevels = $event->levels->pluck('id')->toArray();

        return view('admin.events.edit')
            ->with('event',$event)
            ->with('eventLevels',$eventLevels);

    }

    public function updateEvent($id, Request $request)
    {
        $request->validate([
            'theme' => 'required|max:255',
            'comment' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required',
        ]);

        $event = $this->event->findOrFail($id);

        $event->theme = $request->theme;
        $event->comment = $request->comment;
        $event->location = $request->location;
        $event->date = $request->date;
        if($request->image){
            $this->deleteImage($event->image);
            $event->image = $this->saveImage($request);
        }

        $event->save();
        $event->levels()->detach();

        foreach($request->level as $level) {
            $event->levels()->attach($level);
        }

        return redirect()->route('admin.showEvents');
    }

    public function destroyEvent($id)
    {
        Event::destroy($id);
        return redirect()->back();
    }

    public function showParticipants($event_id)
    {
        $event = Event::findOrFail($event_id);
        $participants = $event->joinEvents()->get();
    
        return view('admin.events.participants')
            ->with('participants',$participants)
            ->with('event',$event);

    }
    

    // Inbox
    public function showInbox()
    {
        $all_messages = Contact::all();

        return view('admin.inbox.index')->with('all_messages',$all_messages);
    }
}
