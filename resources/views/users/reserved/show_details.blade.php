@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/modal.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="category">
                    <div class="pt-3 ps-4">
                        <a href="{{ route('users.top') }}" class="text-secondary"><i
                                class="fa-solid fa-angles-left fa-lg"></i> back</a>
                    </div>

                    <h2 class="display-5 pt-0">My Schedule</h2>
                    <h3 class="fs-3 ms-5">Chat Room</h3>
                    @forelse ($all_meetings as $meeting)
                        {{-- Meeting --}}
                        <div class="mx-auto mb-2 py-2 meeting-table row">
                            <div class="col-3">
                                {{ $meeting->date }}&nbsp;{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                            </div>
                            <div class="col-1">
                                <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm"
                                    alt="{{ $meeting->level->name }}">
                            </div>
                            <div class="col-1">
                                {{ $meeting->category->name }}
                            </div>
                            <div class="col-4">
                                {{ mb_substr($meeting->title, 0, 30) }}{{ mb_strlen($meeting->title) > 30 ? '...' : '' }}
                            </div>
                            <div class="col-1 text-center">
                                @if ($meeting->joinMeetings->count() >= 2)
                                    <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                        class="text-muted">
                                        <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                    </a>
                                @else
                                    <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                @endif
                            </div>
                            <div class="col-1 text-center">
                                @if ($meeting->meetingOpen())
                                    <button class="btn btn-light text-warning" id="btn-join" data-bs-toggle="modal"
                                        data-bs-target="#join-{{ $meeting->id }}">JOIN</button>
                                    @include('users.reserved.modals.join')
                                @endif
                            </div>
                            <div class="col-1 category-item dropdown">
                                <a class="text-muted" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                @if ($meeting->user_id == Auth::user()->id)
                                    <div class="dropdown-menu">
                                        <a href="{{ route('users.meeting.edit', ['meeting' => $meeting->id]) }}"
                                            class="dropdown-item text-success">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button data-bs-toggle="modal" data-bs-target="#delete-{{ $meeting->id }}"
                                            class="dropdown-item text-danger">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                    @include('users.reserved.modals.delete')
                                @else
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#cancel_meeting-{{ $meeting->id }}">
                                            <i class="fa-solid fa-xmark"></i> Cancel
                                        </a>
                                    </div>
                                    @include('users.reserved.modals.cancel_meeting')
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No reserved Chat Room</p>
                    @endforelse

                    {{-- event --}}
                    <h3 class="fs-3 ms-5 mt-4">Event</h3>
                    @if (empty($participant))
                        <p class="text-center">No participant</p>
                    @else
                        @forelse($participant->joinEvents as $event)
                            <div class="mx-auto mb-2 py-2 event-table text-center row">
                                <div class="col-3">
                                    @php($carbonDateTime = \Carbon\Carbon::parse($event->date))
                                    {{ $carbonDateTime->toDateString() }}&emsp;{{ $carbonDateTime->format('H:i') }}
                                </div>
                                <div class="col">
                                    {{ mb_substr($event->theme, 0, 30) }}{{ mb_strlen($event->theme) > 30 ? '...' : '' }}
                                </div>
                                <div class="col">
                                    <i class="fa-solid fa-location-dot"></i>
                                    &nbsp;{{ mb_substr($event->location, 0, 20) }}{{ mb_strlen($event->location) > 20 ? '...' : '' }}
                                </div>
                                <div class="col-1">
                                    @if ($event->joinEvents->count() >= 2)
                                        <a href="{{ route('users.reserved.showOtherEventJoinMember', $event->id) }}"
                                            class="text-muted">
                                            <i class="fa-solid fa-users"></i> {{ $event->joinEvents->count() }}
                                        </a>
                                    @else
                                        <i class="fa-solid fa-users"></i> {{ $event->joinEvents->count() }}
                                    @endif
                                </div>
                                <div class="col-1 dropdown">
                                    <a class="text-muted" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>
                                    <div class="dropdown-menu event-dropdown text-start">
                                        <a class="dropdown-item text-start text-danger" data-bs-toggle="modal"
                                            data-bs-target="#cancel-event-{{ $event->id }}">
                                            <i class="fa-solid fa-circle-xmark"></i> Not Joining
                                        </a>
                                        <a class="dropdown-item text-start" href="{{ route('events.show', $event->id) }}">
                                            <i class="fa-solid fa-circle-plus"></i> More Information
                                        </a>
                                    </div>
                                </div>
                                @include('users.reserved.modals.cancel_event')
                            </div>
                        @empty
                            <p class="text-center">No reserved Event</p>
                        @endforelse
                    @endif
                </div>
            </div>

            <div class="col-3">
                @include('users.profile.show')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function goBack() {
            history.back();
        }
    </script>
@endsection
