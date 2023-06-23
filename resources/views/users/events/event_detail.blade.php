@extends('layouts.app')

@section('title', 'Event Detail')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/event.css') }}">
@endsection

@section('content')
    <div class="container event-container">
        <div class="card event-detail-card">
            <div class="row">
                <!-- left side picture -->
                <div class="col-lg-6 col-md-12 event-detail-pic">
                    <div class="event-detail-img">
                        <img src="{{ asset('/storage/images/' . $event->image) }}" alt="{{ $event->image }}">
                    </div>
                </div>
                <!-- end of left side picture -->
                <!-- right side  -->
                <div class="col-lg-6 col-md-12">
                    <h1 class="mt-5 event-detail-title"><u>{{ $event->theme }}</u></h1>
                    <p class="event-p me-4">
                        {{ $event->comment }}
                        <br>
                        (This event last about 90min or more)
                    </p>
                    <div class="event-info ms-5 ">
                        <p class="text-start">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Begins: <label>&nbsp;<span><strong>{{ $event->date }}</strong></span></label></span>
                        </p>
                        <p class="text-start">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Location: <label>&nbsp;<span><strong>{{ $event->location }}</strong></span></label></span>
                        </p>
                        <div class="text-start">
                            @if ($event->levels()->count() === 3)
                                <p class=mb-0>all users available</p>
                            @else
                                <span>mainly for &nbsp;</span>
                                @foreach ($event->levels as $level)
                                    <img src="{{ asset('image/level/' . $level->icon) }}" class="mb-2 icon-sm"
                                        alt="{{ $level->name }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="text-end mt-0">
                        {{-- Modal --}}
                        @if (auth()->check())
                            @if (!$isJoined)
                                <button class="button btn-orange m-4 mt-0" data-bs-toggle="modal"
                                    data-bs-target="#join-event-{{ $event->id }}">
                                    Join!!
                                </button>
                            @endif
                        @else
                            <a href="{{ route('events.joinForm', $event->id) }}" class="button btn-orange m-4 mt-0">
                                Join!!
                            </a>
                        @endif
                    </div>
                    @include('users.events.modals.join_event')
                </div>
                <!-- end of right side -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#join-event-result').modal('show');
        });
    </script>
@endsection