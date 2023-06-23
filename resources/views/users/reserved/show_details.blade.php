@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-8">
            <div class="category">
                <h2 class="display-5">My Schedule</h2>
                  <h3 class="fs-3 ms-5">Chat Room</h3>
                  @forelse($user->joinMeetings as $meeting)
                    <div class="category-myroom mx-auto mb-2">
                      <div class="category-item">
                        {{ $meeting->date }}<br>{{ $meeting->start_at}}〜
                      </div>
                      {{-- <div class="category-item">
                        <img src="image/begginer.png" alt="">
                      </div> --}}
                      <div class="category-item">
                        {{ $meeting->category->name}}
                      </div>
                      <div class="category-item">
                        {{ $meeting->title }}
                      </div>
                      <div class="category-item">
                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}" class="text-muted">
                        <i class="fa-solid fa-users"></i>
                        </a>
                      </div>
                      <div class="category-item">
                        <button class="btn btn-light text-warning" id="btn-join">JOIN</button>
                      </div>
                      {{-- create EDIT & DELETE select box --}}
                      <div class="category-item dropdown">
                        <button class="btn shadow-none" data-bs-toggle="dropdown">
                          <i class="fa-solid fa-ellipsis"></i>
                        </button>
                          <div class="dropdown-menu">
                            <a href="" class="dropdown-item">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="" class="dropdown-item text-danger">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                          </div>
                          {{-- @include('') --}}

                      </div>
                    </div>
                    @empty
                        <p>No reserved</p>
                    @endforelse
                    
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
                          {{ $event->comment }}
                        </div>
                        <div class="category-item">
                          {{ $event->location }}
                        </div>
                        <div class="category-item">
                          {{ $event->joinEvents->count() }}members
                          {{-- {{ dd($event->joinEvents )}} --}}
                        </div>
                        <div class="category-item">
                          <i class="fa-solid fa-trash-can text-danger"></i>
                        </div>
                      </div>
                      @empty
                            <p>No reserved</p>
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
