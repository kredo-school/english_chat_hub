@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/follow.css') }}">
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection
@section('content')

<div class="container">
    <div class="body mb-5">
        <a href="{{ route('users.top') }}" class="text-secondary text-decoration-none me-4">
            <i class="fa-solid fa-angles-left fa-lg"></i> Back
        </a>
        <div class="user-avatar">
            @if ($user->avatar)
                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="follow-avatar-md">
            @else
                <i class="fa-solid fa-circle-user text-secondary d-block text-center follow-icon-lg"></i>
            @endif
        </div>
                  
        <div class="profile-user mt-2">
            <div class="about-user">
                <div class="user-detail">
                    <div class="profile-avatar-level">
                        <img src="{{ asset('image/level/' . $user->level->icon) }}" class="icon-sm mx-auto" alt="{{ $user->level->name }}">
                    </div>
                    <h3 class="username">{{ $user->full_name }}</h3>
                    <div class="follow-edit-button">
                        @if (Auth::user()->id === $user->id)
                            <button href="{{ route('users.profile.edit') }}" class="btn btn-light follow-edit-btn mb-3 text-warning w-3">Edit Profile</button> 
                        @else
                            @if ($user->following()->where('id', Auth::user()->id)->exists())
                                <form action="{{ route('users.follow.unfollow', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light edit-btn mb-3 text-warning">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('users.follow.follow', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-light edit-btn mb-3 text-warning">Follow</button>
                                </form>
                            @endif  
                        @endif 
                    </div>
                </div>
                <div class="sub-detail">
                    <div class="count-users">
                        <a href="" data-bs-toggle="modal" data-bs-target="#follower-{{ $user->id }}" class="following">
                            <strong>{{ $user->following()->count() }}</strong> {{ $user->following()->count() == 1 ? 'follower' : 'followers'  }}
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#following-{{ $user->id }}" class="follower">
                            <strong>{{ $user->followers()->count() }}</strong> following
                        </a>
                    </div>
                    @include('users.profile.modal.follower')
                    @include('users.profile.modal.following')
                    <br>
                </div>
                <div class="comment">{{ $user->comment }}</div>
            </div>
        </div>
    </div>
    @include('users.profile.chatroom-as-host')
    @include('users.profile.chatroom-as-participant')
</div>

@endsection
        
