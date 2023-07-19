@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/follow.css') }}">
@endsection

@section('content')
@include('users.profile.header')

<div class="main">
    <div class="wrapper">
        @if ($following->isNotEmpty())
            <div class="col-8">
                <h3 class="text-muted text-center title">Followers</h3>

                @foreach ($user->following as $following )
                    <div class="row align-items-center-mt-3 users">
                        <div class="col-auto">
                            <a href="{{ route('users.profile.show', $following->id) }}">
                                @if ($following->avatar)
                                    <img src="{{ asset('storage/avatars/' . $following->avatar) }}" alt="{{ $following->avatar }}" class="rounded-circle icon-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col text-truncate">
                            <a href="{{ route('users.follow.follower', $following->id) }}" class="text-decoration-none text-dark fw-bold username">{{ $following->user_name }}</a>
                        </div>
                        <div class="col-auto text-end">
                            @if ($following->id != Auth::user()->id)  
                                @if (Auth::user()->followers()->where('id', $following->id)->count() > 0)
                                    <form action="{{ route('users.follow.unfollow', $following->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent btn-sm-unfollow">Unfollow</button>
                                    </form>
                                @else
                                    <form action="{{ route('users.follow.follow', $following->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="border-0 bg-transparent p-0 btn-sm-follow">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center mt-5 mb-5">No Followers Yet.</h3>
        @endif
    </div>
</div>
@endsection