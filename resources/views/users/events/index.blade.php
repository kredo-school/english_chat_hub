@extends('layouts.app')

@section('title', 'Event')

@section('banner')
    <img src="{{ asset('/image/event.top.png') }}" alt="event-image" class="event-image-top">
@endsection

@section('style')
    <link rel="stylesheet" href="{{ mix('css/event.css') }}">
@endsection

@section('content')
    <div class="container-fluid align-items-center">
        <div class="m-5">
            <h1 class="title display-3">Up Coming Events</h1>
            <div class="m-5">
                <h2 class="event-h2 display-3">Let's join an event!!</h2>
            </div>
            <p class="event-p display-6">
                Would you like to meet up and chat with your new friends? <br>
                Don't hesitate to join events! It is okay to join event if you've never join any chat room yet. <br>
                You might feel shy at the beginning, <br>
                but others are feeling the same! Click an event and check the details below. <br>
            </p>
            @if ($filtered_events->isNotEmpty())
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($filtered_events as $index => $events)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                                {{ $index === 0 ? 'class=active' : '' }}></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner" id="up-coming-event">
                        @foreach ($filtered_events as $index => $events)
                            <div class="carousel-item{{ $index === 0 ? ' active' : '' }}" data-bs-interval="5000">
                                <div class="row mt-5 mb-5">
                                    @foreach ($events as $event)
                                        @php($eventDate = strtotime($event->date))
                                        @php($todayDate = strtotime(date('Y-m-d')))
                                        @if ($eventDate >= $todayDate && $event->joinEvents->count() < $event->participants_limit)
                                        @php($carbonDateTime = \Carbon\Carbon::parse($event->date))
                                            <div class="col-lg-4 col-md-6 gx-0 p-0 mx-auto event-info mb-5">
                                                <div class="card event-card mb-2">
                                                    <img src="{{ asset('storage/images/' . $event->image) }}"
                                                        class="card-img-top" alt="{{ $event->image }}">
                                                    <div class="event-card-body text-start m-5">
                                                        <p>
                                                            <i class="fa-regular fa-comment"></i>
                                                            <span class="ms-1">{{ $event->theme }}</span>
                                                        </p>
                                                        <p>
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                            <span class="ms-1">{{ $carbonDateTime->toDateString() }}</span>
                                                        </p>
                                                        <p>
                                                            <i class="fa-regular fa-clock"></i>
                                                            <span class="ms-1">{{ $carbonDateTime->format('H:i') }}</span>
                                                        </p>
                                                        <p>
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            <span class="ms-1">{{ $event->location }}</span>
                                                        </p>
                                                        <p class="text-center text-success fs-5 mt-5">
                                                            Number of available applicants <br>
                                                            <span class="fw-bold fs-1">{{ $event->participants_limit - $event->joinEvents->count() }}</span> people left
                                                        </p>
                                                        <p class="text-end">
                                                            <a href="{{ route('events.show', $event->id) }}" id="event-a">>>more</a>
                                                        </p>
                                                    </div>
                                                    <div class="event-card-footer">
                                                        @if ($event->levels()->count() === 3)
                                                            <p class=mb-0>all users available</p>
                                                        @else
                                                            <span>mainly for</span>
                                                            @foreach ($event->levels as $level)
                                                                <img src="{{ asset('image/level/' . $level->icon) }}"
                                                                    class="icon-sm" alt="{{ $level->name }}">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev chevron chevron-left" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next chevron chevron-right" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <h1 class="text-center text-muted mt-5">Sorry<i class="fa-solid fa-face-sad-tear"></i>...No Event yet...</h1>
            @endif
        </div>
    </div>
@endsection
