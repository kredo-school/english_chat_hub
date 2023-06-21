@extends('layouts.app')

@section('title','Event')

@section('banner')
  <img src="{{ asset('/image/event.top.png')}}" alt="event-image" class="event-image-top">
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
          Don't hesitate to join events!  It is okay to join event if you've never join any chat room yet. <br>
          You might feel shy at the biggining, <br>
          but others are feeling same!  Click an event and check the detail below. <br>
        </p>
    @if($all_events->isNotEmpty())
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        @for($i = 0, $indicator = 1, $indicatorCount = 0; $i < count($all_events); $i++, $indicator++)
          @if($indicator == 3)
            @if ($i === 2)
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $indicatorCount }}" class="active" aria-current="true" aria-label="Slide {{ $indicatorCount + 1 }}"></button>
            @else
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $indicatorCount }}" aria-label="Slide {{ $indicatorCount + 1 }}"></button>
            @endif
            @php($indicator = 1) 
            @php($indicatorCount++)
          @endif
        @endfor
      </div>
      <div class="carousel-inner">
        <!-- For the card container -->
        @for($i = 0; $i < count($all_events); $i++) 
        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
          {{-- card --}}
          <div class="row mt-5 mb-5">
            <!-- For the cards -->
            @for($j = 0; $j < 3; $j++, $i++)
              @if ($i+1 == count($all_events))
                @break
              @endif
              <div class="col-lg-4 col-md-6 gx-0 p-0 mx-auto event-info mb-5">
                <div class="card event-card mb-2">
                  <img src="{{ asset('storage/images/' . $all_events[$i]->image) }}" class="card-img-top"  alt="{{$all_events[$i]->image}}">
                    <div class="event-card-body text-start m-5">
                      <p>
                        <i class="fa-regular fa-comment"></i>
                        <span class="ms-1">{{$all_events[$i]->theme}}</span>
                      </p>
                      <p>
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="ms-1">{{$all_events[$i]->date}}</span>
                      </p>
                      <p>
                        <i class="fa-solid fa-location-dot"></i>
                        <span class="ms-1">{{$all_events[$i]->location}}</span>
                      </p>
                      <p class="text-end">
                        <a href="{{ route('events.show', $all_events[$i]->id)}}">>>more</a>
                      </p>
                    </div>
                    <div class="event-card-footer">
                      @if ($all_events[$i]->levels()->count() === 3)
                        <p class=mb-0>all users available</p>
                      @else
                        <span>mainly for</span>
                        @foreach ($all_events[$i]->levels as $level)
                          <img src="{{asset('image/level/'. $level->icon)}}"  class="mb-2 icon-sm" alt="{{$level->name}}">
                        @endforeach
                      @endif
                    </div>
                </div>
              </div>
              
              @if ($j+1 == 3)
                @php($i--)
                @break
              @endif
            @endfor
          </div>
          {{-- end card --}}
        </div>
        @endfor
      </div>
      <button class="carousel-control-prev"  type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    @else
      <h1 class="text-center text-muted mt-5">Sorry<i class="fa-solid fa-face-sad-tear"></i>...No Event yet...</h1>
    @endif
  

    @endsection