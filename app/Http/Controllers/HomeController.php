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
    public function index()
    {
        $all_categories = $this->category->all();
        $all_meetings   = $this->meeting->all();
        $all_rooms      = Room::all();
        $all_levels     = Level::all();
        $user           = Auth::user();

        $now        = now();
        $date       = now()->format('Y-m-d');
        $timeTable  = [];
        if (now()->hour < 10) {
            $now = Carbon::parse('10:00:00');
        }
        if (now()->minute >= 45) {
            $now = now()->addMinutes(15);
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
            ->with('date', $date)
            ->with('timeTable', $timeTable);
    }

    public function show()
    {
        Meeting::updateStatus();
        $user = Auth::user();
        $participant = Participant::where('email', $user->email)->first();
        $all_meetings = $user->joinMeetings()->where('status_id', '!=', Meeting::STATUS['done']['id'])->orderBy('date')->orderBy('start_at')->paginate(10);

        return view('users.reserved.show_details')
            ->with('user', $user)
            ->with('participant', $participant)
            ->with('all_meetings', $all_meetings);
    }

    public function showUser(Meeting $meeting)
    {
        $all_users = $meeting->joinMeetings;

        return view('users.reserved.join_users')
            ->with('meeting', $meeting)
            ->with('all_users', $all_users);
    }

    public function showOtherEventJoinMember(Event $event)
    {
        $all_users = $event->joinEvents;
        return view('users.reserved.join_event_users')
            ->with('all_users', $all_users)
            ->with('event', $event);
    }

    public function showMeeting(Category $category)
    {
        Meeting::updateStatus();
        $today = now();
        $all_meetings = $category->meetings()->where('status_id', '!=', Meeting::STATUS['done']['id'])->paginate(10);

        $user           = Auth::user();
        $all_categories = Category::all();
        $all_levels     = Level::all();
        $all_rooms      = Room::all();

        for ($i = 0; $i < 7; $i++) {
            if ($i == 0 && $today->hour > 21) {
                continue;
            } else {
                $dateList[] = $today->copy()->addDays($i)->format('Y-m-d');
            }
        }
        foreach ($dateList as $date) {
            for ($i = 10; $i < 24; $i++) {
                if ($date == $today->format('Y-m-d')) {
                    $i = ($i < intval($today->format('H') + 2) ? intval($today->format('H') + 2) : $i);
                }
                $timeList[$date][] = [$i . ':00', $i + 1 . ':00'];
            }
        }
        $rangedMeetings = Meeting::where('date', '>=', $today->format('Y-m-d'))->where('date', '<=', $today->copy()->addDays(7)->format('Y-m-d'))->get();
        $filledRooms = [];
        foreach ($rangedMeetings as $m) {
            $filledRooms[$m->date][date('H:i', strtotime($m->start_at))][] = $m->room_id;
        }
        foreach ($dateList as $d) {
            foreach ($timeList[$d] as $t) {
                foreach ($all_rooms as $r) {
                    if (
                        array_key_exists($d, $filledRooms,)
                        && array_key_exists($t[0], $filledRooms[$d],)
                        && in_array($r->id, $filledRooms[$d][$t[0]])
                    ) {
                        continue;
                    } else {
                        $availableRooms[$d][$t[0]][] = $r->id;
                    }
                }
            }
        }

        return view(
            'users.research.show',
            compact(
                'all_meetings',
                'all_categories',
                'all_levels',
                'all_rooms',
                'user',
                'category',
                'availableRooms',
            )
        );
    }
}
