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
                        {{-- Meeting Table --}}
                        <div class="mx-auto mb-2 py-2 meeting-table">
                            <table class="table table-borderless row mb-0 align-middle">
                                <tr>
                                    <td class="col-3">
                                        {{ $meeting->date }}&nbsp;{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                                    </td>
                                    <td class="col-1">
                                        <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm"
                                            alt="{{ $meeting->level->name }}">
                                    </td>
                                    <td class="col-1">
                                        {{ $meeting->category->name }}
                                    </td>
                                    <td class="col-5">
                                        {{ mb_substr($meeting->title, 0, 40) }}{{ mb_strlen($meeting->title) > 40 ? '...' : '' }}
                                    </td>
                                    <td class="col-1 text-center">
                                        @if ($meeting->joinMeetings->count() >= 2)
                                            <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                                class="text-muted">
                                                <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                            </a>
                                        @else
                                            <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                        @endif
                                    </td>
                                    <td class="col-2 text-center">
                                        @if($meeting->meetingOpen())
                                            <button class="btn btn-light text-warning" id="btn-join" data-bs-toggle="modal"
                                                data-bs-target="#join-{{ $meeting->id }}">JOIN</button>
                                            @include('users.reserved.modals.join')
                                        @endif
                                    </td>
                                    <td class="col-1 category-item dropdown">
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
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @empty
                        <p class="text-center">No reserved Chat Room</p>
                    @endforelse

                    {{-- event table --}}
                    <h3 class="fs-3 ms-5 mt-4">Event</h3>
                    @if (empty($participant))
                        <p class="text-center">No participant</p>
                    @else
                        @forelse($participant->joinEvents as $event)
                            <div class="mx-auto mb-2 py-2 event-table text-center">
                                <table class="table table-borderless row mb-0">
                                    <tr>
                                        <td class="col-3">
                                            {{ $event->date }}
                                        </td>
                                        <td class="col" style="width: 500px">
                                            {{ mb_substr($event->location, 0, 40) }}{{ mb_strlen($event->location) > 40 ? '...' : '' }}
                                        </td>
                                        <td class="col-1">
                                            @if ($event->joinEvents->count() >= 2)
                                                <a href="{{ route('users.reserved.showOtherEventJoinMember', $event->id) }}"
                                                    class="text-muted">
                                                    <i class="fa-solid fa-users"></i> {{ $event->joinEvents->count() }}
                                                </a>
                                            @else
                                                <i class="fa-solid fa-users"></i> {{ $event->joinEvents->count() }}
                                            @endif
                                        </td>
                                        <td class="col-1 dropdown">
                                            <a class="text-muted" data-bs-toggle="dropdown">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu event-dropdown text-start">
                                                <a class="dropdown-item text-start text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cancel_event-{{ $event->id }}">
                                                    <i class="fa-solid fa-circle-xmark"></i> Not Joining
                                                </a>
                                                <a class="dropdown-item text-start"
                                                    href="{{ route('events.show', $event->id) }}">
                                                    <i class="fa-solid fa-circle-plus"></i> More Information
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
