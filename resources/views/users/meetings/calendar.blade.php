<div class="timetable mx-auto" id="time-table">
    <h2 class="display-5">TIME TABLE</h2>

    <div class="meeting-table mx-auto">
        <div class="timetable-date fs-5">
            <a href="{{ route('users.meetings.result',date('Y-m-d',strtotime(now()->copy()->subDay()))) }}"
                class="">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <button class="calendar-btn fs-5 ms-0 mb-2" data-bs-toggle='modal' data-bs-target='#calendar-modal'
                type="button">
                {{ date('Y-m-d', strtotime(now())) }}
            </button>
            <a href="{{ route('users.meetings.result',date('Y-m-d',strtotime(now()->copy()->addDay()))) }}"
                class="">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
        <!-- Calendar modal -->
        <div class="modal fade" id="calendar-modal">
            <div class="modal-dialog">
                <div class="modal-content position-relative">
                    <div class="modal-body">
                        <div class="wrapper">

                            <!-- mounth -->
                            <div id="next-prev-button">
                                <button id="prev" onclick="prev()">‹</button>
                                <h1 id="header"></h1>
                                <button id="next" onclick="next()">›</button>
                            </div>
                            <!-- Calendar -->
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <button type="button" class="bg-white btn-close position-absolute top-0 end-0"
                        data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
        <table class="table text-center align-middle">
            <tbody>
                @for ($i = 0, $time = now()->hour; $time <= 24; $i++, $time++)
                    <tr>
                        <th>{{ $timeTable[$i][0] . '~' . $timeTable[$i][1] }}</th>
                        @foreach ($all_rooms as $room)
                            @if ($meeting = $room->meetings()->where('date', now()->format('Y-m-d'))->where('start_at', $timeTable[$i][0])->first())
                                <td>
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
                                </td>
                            @else
                                <td>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#create-meeting-{{ $i }}" class="date-btn"
                                        title="Create Meeting"></button>
                                </td>
                            @endif
                            @include('users.meetings.modals.calendar')
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="tip mx-auto mt-3">
        <h3 class="tip-title">Join Chat Room</h3>
        <p class="tip-body">Click on the full you want to join and you'll get a join page!</p>
    </div>
    <div class="tip mx-auto mt-1 mb-3">
        <h3 class="tip-title">Join Chat Room</h3>
        <p class="tip-body">Click on the full you want to join and you'll get a join page!</p>
    </div>
</div>
