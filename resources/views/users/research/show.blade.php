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
                <h2 class="display-5 mb-3">{{ $category->name }}</h2>
                  @forelse($all_meetings as $meeting)
                    <div class="category-myroom mx-auto mb-2">
                      <div class="category-item">
                        {{ $meeting->date }}<br>{{ $meeting->start_at }} : 00〜
                      </div>
                      {{-- fix later --}}
                      {{-- <div class="category-item">
                        <img src="image/begginer.png" alt="">
                      </div> --}}
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
                          <i class="arrow fa-solid fa-arrow-right-long fa-lg"></i>
                        </a>
                      </div>
                    </div>
                  @empty
                        <p>No meeting</p>
                  @endforelse

                    {{-- Pagination --}}
                    <nav aria-label="Page navigation">
                      <ul class="pagination pagination-sm justify-content-end me-4 my-3">
                        <li class="page-item">
                          <a class="page-link text-warning" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item"><a class="page-link text-muted" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-muted" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-muted" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link text-warning" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
              </div>
            </div>
      
          <div class="col-4">
              @include('users.profile.show')
              @include('users.reserved.show')
          </div>
      </div>

      {{-- INCLUEDE MODAL --}}
      @include('users.research.modals.reservation')
  </div>
@endsection