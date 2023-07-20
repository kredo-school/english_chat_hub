<div class="timetable mx-auto position-relative" id="time-table">
    <h2 class="display-5">TIME TABLE</h2>

    <div class="meeting-table mx-auto">
        <a href="" class="question fs-5"><i class="fa-solid fa-circle-question fa-lg mb-4"></i> How to use</a>
        <div class="timetable-date fs-5">
            <button class="calendar-btn fs-5 ms-0 mb-2" data-bs-toggle='modal' data-bs-target='#calendar-modal'
                type="button">
                <i class="fa-solid fa-calendar text-dark"></i> {{ date('Y-m-d', strtotime(now())) }}
            </button>
        </div>

        <!-- Calendar modal -->
        @include('users.meetings.modals.calendar')

        <table class="table text-center align-middle">
            <tbody>
                @for ($i = 0, $time = now()->hour; $time < 24 && $i < 14; $i++, $time++)
                    <tr>
                        <th>{{ $timeTable[$i][0] . '~' . $timeTable[$i][1] }}</th>
                        @foreach ($all_rooms as $room)
                            <td>
                                @if ($meeting = $room->meetings()->where('date', now()->format('Y-m-d'))->where('start_at', $timeTable[$i][0])->first())
                                    @if ($meeting->joinMeetings()->where('user_id', Auth::user()->id)->first())
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#join-{{ $meeting->id }}" class="date-btn"
                                            title="Join Meeting"
                                            style="background-color: {{ $meeting->category->color }}">
                                            <i class="fa-solid fa-check"></i> {{ $meeting->category->name }}
                                        </button>
                                        @include('users.reserved.modals.join')
                                    @else
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#reservation-{{ $meeting->id }}" class="date-btn"
                                            title="Join Meeting"
                                            style="background-color: {{ $meeting->category->color }}">
                                            <i class="fa-solid fa-plus"></i> {{ $meeting->category->name }}
                                        </button>
                                    @endif
                                @else
                                    @if (Auth::user()->meetingCheck($date, $timeTable[$i][0]) && $timeTable[$i][0] >= now()->addMinutes(60)->format('H:i'))
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#create-meeting-{{ $i . '-' . $room->id }}" class="date-btn"
                                            title="Create Meeting">
                                        </button>
                                    @else
                                        <button disabled="disabled" class="date-btn"></button>
                                    @endif
                                @endif
                            </td>
                            @include('users.meetings.modals.calendar-action')
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="tip mx-auto mt-3">
        <h3 class="tip-title">Join Chat Room</h3>
        <p class="tip-body">Click on the "category" you want to join and you'll get a join page!</p>
    </div>
    <div class="tip mx-auto mt-1 mb-3">
        <h3 class="tip-title">Create Chat Room</h3>
        <p class="tip-body">Click on the null time where you want to create and you'll get a create form!</p>
    </div>
    <div class="col-8 mx-auto">
        <p class="">* You can join only one meeting at the same time.</p>
        <p class="">* If you want to cancel meeting, you can do it in your schedule page.</p>
    </div>
</div>
