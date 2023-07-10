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
                <h2 class="display-5 mb-3">{{ $category->name }}</h2>
                  @forelse($all_meetings as $meeting)
                    <div class="category-myroom mx-auto mb-2">
                      <div class="category-item">
                        {{ $meeting->date }}<br>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                      </div>
                      <div class="category-item">
                        <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="mb-2 level-img-md" alt="{{ $meeting->level->name }}">                                      
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
                        <a class="text-muted" data-bs-toggle="modal" data-bs-target="#reservation-{{ $meeting->id }}">
                          <i class="fa-solid fa-circle-plus fa-xl text-white"></i>
                        </a>
                      </div>
                    </div> 
                    @include('users.research.modals.reservation')
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
