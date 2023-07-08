@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/meeting_calendar.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="category">
                    <h2 class="display-5">CATEGORY</h2>
                    <p class="h5" id="category-title">Click the icon you're interested in!</p>
                    <div class="row mt-3 justify-content-center">
                        @forelse($all_categories as $category)
                            <div class="card col-lg-3 col-md-6 mb-4 p-0">
                                <a href="{{ route('users.research.show', $category->id) }}"
                                    class="text-muted text-decoration-none">
                                    <div class="card-top"
                                        style="height: 156.31px; background-color: {{ $category->color }};">
                                        <img src="{{ asset('image/category/' . $category->icon) }}" alt=""
                                            class="card-img-top">
                                </a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-center" id="category-title">{{ $category->name }}</h5>
                                <p class="card-text">{{ $category->description }}</p>
                            </div>
                    </div>
                        @empty
                        @endforelse
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('users.profile.show')
            @include('users.reserved.show')
        </div>
    </div>
    
    @include('users.meetings.calendar')
@endsection

@section('script')
    <script src="{{ asset('js/meeting_calendar.js') }}"></script>
@endsection