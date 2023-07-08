{{-- RESERVED CHAT ROOM --}}
   <div class="reserved">
      <h2 class="display-7">RESERVED<br>CHAT ROOM</h2>
          @php $count = 0; @endphp
          @forelse($user->joinMeetings()->where(function ($query) {
            $query->where('date', '>', today()->toDateString())
                  ->orWhere(function ($query) {
                    $query->where('date', '=', today()->toDateString())
                          ->where('start_at', '>=', now()->format('H:i'));
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
              </div>
              @php $count++; @endphp
              @endif
          @empty
              <p>Not reserved Chat Room</p>
          @endforelse

          <a href="{{ route('users.reserved.show.details') }}"><p class="text-end pe-4 pt-1 pb-3 fs-5">My Schedule</p></a>
   </div>