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

    const LOCAL_STORAGE_FOLDER = 'image/events/';

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
            'level' => 'required|array',
            'limit' =>'numeric|max:20',
            'image' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $date = $request->input('date');
        $time = $request->input('time');

        $this->event->theme = $request->theme;
        $this->event->comment = $request->comment;
        $this->event->location = $request->location;
        $this->event->date = $date.' '.$time.':00';
        $this->event->image = $this->saveImage($request);
        $this->event->participants_limit = $request->limit;

        $this->event->save();

        if ($request->has('level')) {
            foreach ($request->input('level') as $level) {
                $this->event->levels()->attach($level);
            }
        }

        return redirect()->route('admin.events.show');
    }

    public function saveImage($request)
    {
        $image_name = time().".". $request->image->extension();

        // $request->image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name);
        // Storage::disk('public')->putFileAs('/image/event/', $request->image, $image_name);
        Storage::disk('public')->putFileAs(self::LOCAL_STORAGE_FOLDER, $request->image, $image_name);

        return $image_name;

    }
    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER.$image_name;

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
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
            'level' => 'required|array',
            'limit' =>'numeric|max:20',
            'image' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $event = $this->event->findOrFail($id);

        $date = $request->input('date');
        $time = $request->input('time');

        $event->theme = $request->theme;
        $event->comment = $request->comment;
        $event->location = $request->location;
        $event->date = $date.' '.$time;
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
