@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/meeting_calendar.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="timetable mx-auto position-relative">
            <h2 class="display-5">TIME TABLE</h2>

            <div class="meeting-table mx-auto">
                <div class="timetable-date fs-5 mb-2">
                    {{ $date }}
                </div>
                <table class="table text-center align-middle">
                    <tbody>
                        @for ($i = 0; $i < 14; $i++)
                            <tr>
                                <th>{{ $timeTable[$i][0] . '~' . $timeTable[$i][1] }}</th>
                                @foreach ($all_rooms as $room)
                                    @if ($meeting = $room->meetings()->where('date', $date)->where('start_at', $timeTable[$i][0] . ':00')->first())
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
            <a href="{{ route('users.top', '#time-table') }}" id="back" class="text-decoration-none fs-3"><i
                    class="fa-solid fa-angles-left"></i> back</a>
        </div>
    </div>
@endsection
