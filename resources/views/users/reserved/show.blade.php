{{-- RESERVED CHAT ROOM --}}
   <div class="reserved">
      <h2 class="display-5">RESERVED<br>CHAT ROOM</h2>
          @php $count = 0; @endphp
          @forelse($user->joinMeetings as $meeting)
              @if( $count<5 )
              <div class="reserved-room mx-auto mt-2 mb-1">
                <div class="reserved-item">
                  {{ $meeting->date }}<br>{{ $meeting->start_at }}〜
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