<div class="modal fade" id="reservation-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">

            <div class=“modal-body”>
                <div class="modal-title text-center fs-3 my-3 fw-bold">Make a Reservation</div>
                <p class="modal-text mx-auto mb-0 fs-4">{{ $meeting->category->name }}</p>
                <p class="modal-text mx-auto mb-3 fs-4">~ {{ $meeting->title }} ~</p>
                <p class="modal-text mx-auto mb-3">Date: {{ $meeting->date }}</p>
                <p class="modal-text mx-auto mb-3">Time: {{ $meeting->start_at }}</p>
                <p class="modal-text mx-auto mb-3">Level: {{ $meeting->level->name }}</p>

                {{-- button --}}
                <div class="buttons mt-5 mb-3 text-center mx-5">
                    @if (!$meeting->joinMeetings()->where('user_id', Auth::user()->id)->first())
                        @if (Auth::user()->meetingCheck($meeting->date, $meeting->start_at) && $meeting->vacanciesCheck())
                            @if ($meeting->date == now()->format('Y-m-d') && $meeting->start_at < now()->addHour()->format('H:i'))
                                <p class="text-danger">Sorry, You can only reserve meetings to one hour before the
                                    meeting</p>
                            @else
                                <form action="{{ route('users.meeting.join', $meeting->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button btn-orange">Reservation</button>
                                </form>
                            @endif
                        @elseif ($meeting->vacanciesCheck())
                            <p class="text-danger">You already joined another meeting this time.</p>
                        @else
                            <p class="text-danger">This meeting has reached its maximum number of users.</p>
                        @endif
                    @else
                        <p class="text-danger">You already reserved this meeting.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
