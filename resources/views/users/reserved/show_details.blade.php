@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/modal.css') }}">
@endsection

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-8">
            <div class="category">
                <h2 class="display-5">My Schedule</h2>
                  <h3 class="fs-3 ms-5">Chat Room</h3>
                  @forelse($user->joinMeetings()->where(function ($query) {
                    $query->where('date', '>', today()->toDateString())
                          ->orWhere(function ($query) {
                            $query->where('date', '=', today()->toDateString())
                                  ->where('start_at', '>=', now()->format('H:i'));
                        });
                  })->orderBy('date')->orderBy('start_at')->get() as $meeting_a)
                    <div class="category-myroom mx-auto mb-2">
                      <div class="category-item">
                        {{ $meeting_a->date }}<br>{{ $meeting_a->start_at }}〜
                      </div>
                      {{-- <div class="category-item">
                        <img src="image/begginer.png" alt="">
                      </div> --}}
                      <div class="category-item">
                        {{ $meeting_a->category->name }}
                      </div>
                      <div class="category-item">
                        {{ $meeting_a->title }}
                      </div>
                      <div class="category-item">
                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting_a->id]) }}" class="text-muted">
                        <i class="fa-solid fa-users"></i>
                        </a>
                      </div>
                      <div class="category-item">
                        @if(Carbon\Carbon::parse($meeting_a->date . '' . $meeting_a->start_at) <= now()->addMinutes(60))
                          <button class="btn btn-light text-warning" id="btn-join" data-bs-toggle="modal" data-bs-target="#join-{{ $meeting->id }}">JOIN</button>
                          @include('users.reserved.modals.join')
                        @endif
                      </div>

                      
                      {{-- create EDIT & DELETE select box --}}
                      <div class="category-item dropdown">
                        <a class="text-muted" data-bs-toggle="dropdown">
                          <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        @if($meeting->user_id == Auth::user()->id)
                          <div class="dropdown-menu">
                            <a href="{{ route('users.meeting.edit', ['meeting' => $meeting->id]) }}" class="dropdown-item text-success">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#delete-{{ $meeting->id }}" class="dropdown-item text-danger">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                          </div>
                          @include('users.reserved.modals.delete')
                        @else
                           <div class="dropdown-menu">
                              <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancel_meeting-{{ $meeting->id }}">
                                <i class="fa-solid fa-xmark"></i> Cancel
                              </a>
                           </div>
                           @include('users.reserved.modals.cancel_meeting')
                        @endif                       
                      </div>
                    </div>
                  @empty
                      <p>Not reserved Chat Room</p>
                  @endforelse
                  {{-- @endif --}}
                   
                  <h3 class="fs-3 ms-5 mt-4">Event</h3>
                  @if(empty($participant))
                    <p>No participant</p>
                  @else
                      @forelse($participant->joinEvents as $event)
                      <div class="category-room mx-auto mb-2 py-2">
                        <div class="category-item">
                          {{ $event->date }}
                        </div>
                        {{-- <div class="category-item">
                          <img src="image/begginer.png" alt="">
                        </div> --}}
                        <div class="category-item">
                          {{ $event->theme }}
                        </div>
                        <div class="category-item">
                          {{ $event->location }}
                        </div>
                        <div class="category-item">
                          {{ $event->joinEvents->count() }}members
                          {{-- {{ dd($event->joinEvents )}} --}}
                        </div>
                        <div class="category-item">
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancel-event-{{ $event->id }}">
                            <i class="fa-solid fa-trash-can text-danger"></i>
                          </a>
                        </div>
                        @include('users.events.modals.join_event')
                      </div>
                      @empty
                            <p>Not reserved Event</p>
                      @endforelse
                  @endif
                  
            </div>
          </div>
      
          <div class="col-4">
              @include('users.profile.show')
          </div>
      </div>
  </div>
@endsection
