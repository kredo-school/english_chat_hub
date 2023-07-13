<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Meeting;
use App\Models\Category;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $category;
    private $user;
    private $meeting;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, User $user, Meeting $meeting)
    {
        $this->category = $category;
        $this->user = $user;
        $this->meeting = $meeting;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $all_categories = $this->category->all();
        $all_meetings = $this->meeting->all();
        $user = Auth::user();

        $all_rooms = Room::all();
        $all_levels = Level::all();
        $timeTable = [];
        if (now()->hour < 10) {
            $now = Carbon::parse('10:00:00');
        } else {
            $now = now();
        }
        for ($i = 0; $i < 15; $i++) {
            $timeTable[$i] = [
                date('G:00', strtotime($now->copy()->addHours($i))), date('G:00', strtotime($now->copy()->addHours($i + 1)))
            ];
        }

        return view('users.top')
        ->with('user', $user)
        ->with('all_categories', $all_categories)
        ->with('all_meetings', $all_meetings)
        ->with('all_rooms', $all_rooms)
        ->with('all_levels', $all_levels)
        ->with('date', now()->format('Y-m-d'))
        ->with('timeTable', $timeTable);
    }

    public function show(){
        $user = Auth::user();
        $participant = Participant::where('email', $user->email)->first();
        $all_meetings = Meeting::all();

        return view('users.reserved.show_details')
        ->with('user', $user)
        ->with('participant', $participant)
        ->with('all_meetings', $all_meetings);
    }

    public function showUser(Meeting $meeting){
        $all_users = $meeting->joinMeetings;

        return view('users.reserved.join_users')
        ->with('meeting', $meeting)
        ->with('all_users', $all_users);
    }

    public function showOtherEventJoinMember(Event $event){
        $all_users = $event->joinEvents;
        return view('users.reserved.join_event_users')
        ->with('all_users', $all_users)
        ->with('event', $event);
    }

    public function showMeeting(Category $category){
        $all_meetings = $category->meetings()->where(function ($query) {
            $query->where('date', '>', today()->toDateString())
                ->orWhere(function ($query) {
                    $query->where('date', '=', today()->toDateString())
                        ->where('start_at', '>=', now()->format('H:i'));
                });
        })->orderBy('date')->orderBy('start_at')->paginate(10);
        
        $user = Auth::user();
        $all_categories = Category::all();
        $all_levels = Level::all();
        $all_rooms = Room::all();
       
        return view('users.research.show', compact('all_meetings', 'category', 'user', 'all_categories', 'all_levels', 'all_rooms'));
    }
}
