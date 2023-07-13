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
                  <a href="javascript:void(0);" onclick="goBack();" class="text-secondary"><i class="fa-solid fa-angles-left fa-lg"></i> back</a>
                </div>
                <h2 class="display-5 mb-3 pt-0">{{ $category->name }}</h2>
                {{-- create meeting button --}}
                  <div class="ms-5 mb-2">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#create-meeting" class="text-secondary" title="Create Meeting">
                          <i class="fa-solid fa-circle-plus fs-5"></i>
                          <span class="ms-2 fs-6">Create New Meeting</span></a>
                  </div>        
    
                  @forelse($all_meetings as $meeting)
                  <div class="category-room mx-auto mb-2">
                      <span class="meeting_date ms-3 my-1">
                        {{ $meeting->date }}<br>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                      </span>
                      <span class="meeting_level ms-3">
                        <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm" alt="{{ $meeting->level->name }}">                                      
                      </span>
                      <span class="meeting_title ms-3">
                        {{ mb_substr($meeting->title, 0, 50) }}{{ mb_strlen($meeting->title) > 50 ? '...' : ''}}
                      </span>
                      <span>
                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}" class="text-muted">
                          <i class="fa-solid fa-users"></i>
                        </a>
                      </span>
                      <span class="ms-3">
                        <a class="text-muted" data-bs-toggle="modal" data-bs-target="#reservation-{{ $meeting->id }}">
                          <i class="fa-solid fa-circle-plus fa-xl text-white"></i>
                        </a>
                      </span>
                        @include('users.research.modals.reservation')
                        @include('users.research.modals.create_meeting')
                  </div>
                                     
                  @empty                
                    <p class="text-center">No meeting</p>                 
                  @endforelse
                  {{-- pagination --}}
                  {{ $all_meetings->links('users.pagination') }}
                    
            </div>
          </div>

          <div class="col-3">
              @include('users.profile.show')
              @include('users.reserved.show')
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