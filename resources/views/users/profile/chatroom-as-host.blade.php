{{-- CHAT ROOM made by the user displayed in the profile --}}
<div class="reserved pb-3">
    <h2 class="display-7 mb-3">Rooms created by {{ $user->user_name }}</h2>
        <div class="container">
            @php $count = 0; @endphp
            @forelse($user->meetings()->where(function ($query) {
            $query->where('date', '>', today()->toDateString())
                    ->orWhere(function ($query) {
                    $query->where('date', '=', today()->toDateString())
                            ->where('start_at', '>=', now()->format('H:i'));
                });
            })->orderBy('date')->orderBy('start_at')->get() as $meeting)

                @if( $count<5 )
                <div class="as-room mx-auto mt-2 mb-1">
                    <table class="table table-borderless mb-0 align-middle row">
                        <tr>
                            <td class="col-1">
                                {{ $meeting->date }}<br>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                            </td>
                            <td class="col-1">
                                <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm me-1 mb-2"
                                    alt="{{ $meeting->level->name }}">
                                    {{ $meeting->title }}
                            </td>
                                <td class="col-1">
                                    @if ($meeting->joinMeetings->count() >= 2)
                                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                            class="text-muted">
                                            <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                        </a>
                                    @else
                                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                            class="text-muted">
                                            <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                        </a>
                                    @endif
                            </td>
                            <td class="col-1">
                                @if($user->id != Auth::user()->id)
                                    @if(Auth::user()->joinMeetings()->where('id', $meeting->id)->count() == 0)
                                        <a class="text-muted ms-1" data-bs-toggle="modal" data-bs-target="#reservation-{{ $meeting->id }}">
                                            <i class="fa-solid fa-plus fa-xl text-warning"></i>
                                        </a>
                                    @elseif($meeting->meetingOpen())
                                            <button class="btn btn-light text-warning" id="btn-join" data-bs-toggle="modal"
                                            data-bs-target="#join-{{ $meeting->id }}">JOIN</button>
                                        
                                    @else
                                        <div class="dropdown">
                                            <a href="" data-bs-toggle="dropdown" aria-haspopup="true">
                                                <i class="fa-solid fa-circle-check text-warning fa-xl"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancel_meeting-{{ $meeting->id }}" class="text-muted ms-1">
                                                    <i class="fa-solid fa-xmark"></i> Cancel
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            </tr>
                        </table>
                        @include('users.research.modals.reservation')
                        @include('users.reserved.modals.cancel_meeting')
                        @include('users.reserved.modals.join')
                </div>
                @php $count++; @endphp
                @endif
            @empty
                <p class="text-center mb-3">No {{ $user->user_name }}'s Chat Room</p>
            @endforelse
        </div>
</div>