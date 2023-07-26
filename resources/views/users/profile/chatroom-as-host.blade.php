{{-- CHAT ROOM made by the user displayed in the profile --}}
<div class="reserved pb-3">
    <h2 class="display-7">AS A HOST</h2>
        @php $count = 0; @endphp
        @forelse($user->meetings()->where(function ($query) {
        $query->where('date', '>', today()->toDateString())
                ->orWhere(function ($query) {
                $query->where('date', '=', today()->toDateString())
                        ->where('start_at', '>=', now()->format('H:i'));
            });
        })->orderBy('date')->orderBy('start_at')->get() as $meeting)

            @if( $count<5 )
            <div class="category-room mx-auto mt-2 mb-1">
                <table class="table table-borderless mb-0 align-middle row">
                    <tr>
                        <td class="col-3">
                            {{ $meeting->date }}<br>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                        </td>
                        <td class="col-1">
                            <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm"
                                alt="{{ $meeting->level->name }}">
                        </td>
                        <td class="col-1">
                            <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                class="text-muted">
                                <i class="fa-solid fa-users"></i>
                            </a>
                        </td>
                        <td class="col-1">
                            {{ $meeting->category->name }}
                            @if(Auth::user()->joinMeetings()->where('id', $meeting->id)->count() == 0)
                                <a class="text-muted ms-1" data-bs-toggle="modal" data-bs-target="#reservation-{{ $meeting->id }}">
                                    <i class="fa-solid fa-circle-plus fa-xl text-warning"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                </table>
                @include('users.research.modals.reservation')
            </div>
            @php $count++; @endphp
            @endif
        @empty
            <p class="text-center mb-3">No {{ $user->user_name }}'s Chat Room</p>
        @endforelse
    </div>