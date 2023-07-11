<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    const LOCAL_STORAGE_FOLDER = '/public/images/';

    // Events
    public function show()
    {
        $all_events = Event::oldest()->paginate(10);
        $today = Carbon::today();
        
        return view('admin.events.index')
            ->with('all_events',$all_events)
            ->with('today',$today);
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|max:255',
            'comment' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'limit' =>'numeric|max:20'
        ]);

        $date = $request->input('date');
        $time = $request->input('time');

        $this->event->theme = $request->theme;
        $this->event->comment = $request->comment;
        $this->event->location = $request->location;
        $this->event->date = $date.' '.$time;
        $this->event->image = $this->saveImage($request);
        $this->event->participants_limit = $request->limit;

        $this->event->save();

        foreach($request->level as $level) {
            $this->event->levels()->attach($level);
        }

        return redirect()->route('admin.events.show');
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

    public function edit(Event $event)
    {
        $eventLevels = $event->levels->pluck('id')->toArray();
        $dateAndTime = $event->date;
        $datetime = new DateTime($dateAndTime);
        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s');
        $data = [
            'date' => $date,
            'time' => $time
        ];

        return view('admin.events.edit', $data)
            ->with('event',$event)
            ->with('eventLevels',$eventLevels);

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'theme' => 'required|max:255',
            'comment' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'limit' =>'numeric|max:20'
        ]);

        $event = $this->event->findOrFail($id);

        $date = $request->input('date');
        $time = $request->input('time');

        $event->theme = $request->theme;
        $event->comment = $request->comment;
        $event->location = $request->location;
        $event->date = $date.' '.$time.':00';
        $event->participants_limit = $request->limit;

        if($request->image){
            $this->deleteImage($event->image);
            $event->image = $this->saveImage($request);
        }

        $event->save();
        $event->levels()->detach();

        foreach($request->level as $level) {
            $event->levels()->attach($level);
        }

        return redirect()->route('admin.events.show');
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->back();
    }

    public function showParticipants($event_id)
    {
        $event = Event::findOrFail($event_id);
        $participants = $event->joinEvents()->paginate(10);
    
        return view('admin.events.participants')
            ->with('participants',$participants)
            ->with('event',$event);

    }
}
