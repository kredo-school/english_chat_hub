{{-- RESERVED CHAT ROOM --}}
<div class="reserved mt-3 pb-3">
    <h2 class="display-7">AS A PARTICIPANT</h2>
    @php $count = 0; @endphp

    @forelse($user->joinMeetings()->where(function ($query) use ($user) {
        $query->where('meetings.user_id', '!=', $user->id) // Exclude the user's own meetings
              ->where(function ($query) {
                $query->where('date', '>', today()->toDateString())
                      ->orWhere(function ($query) {
                          $query->where('date', '=', today()->toDateString())
                                ->where('start_at', '>=', now()->format('H:i'));
                      });
              });
        })->orderBy('date')->orderBy('start_at')->get() as $meeting)

        @if( $count<5 )
            <div class="reserved-room mx-auto mt-2 mb-1">
                <div class="reserved-item">
                    {{ $meeting->date }}<br>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                </div>
                <div class="reserved-item">
                    {{ $meeting->category->name }}
                </div>
                <div class="reserved-item">
                    @if(Auth::user()->joinMeetings()->where('id', $meeting->id)->count() == 0)
                        <a class="text-muted ms-1" data-bs-toggle="modal" data-bs-target="#reservation-{{ $meeting->id }}">
                            <i class="fa-solid fa-circle-plus fa-xl text-warning"></i>
                        </a>
                    @endif
                </div>
                @include('users.research.modals.reservation')
            </div>
            @php $count++; @endphp
        @endif

        @empty
            <p class="text-center">There is no chatroom<br>as a participant</p>
        @endforelse
</div>
