@extends('layouts.app')

@section('script')
    <link rel="stylesheet" href="{{ mix('css/follow.css') }}">
@endsection

@section('content')
    @include('users.profile.header')

<div class="main">
    <div class="wrapper">
        @if ($followers->isNotEmpty())
                <div class="col-8">
                    <h3 class="text-muted text-center title">Following</h3>

                    @foreach ($user->followers as $follower)
                        <div class="row align-items-center mt-3 users">
                            <div class="col-auto">
                                <a href="{{ route('users.follow.follower', $follower->id) }}">
                                    @if ($follower->avatar)
                                        <img src="{{ asset('storage/avatars/' . $follower->avatar) }}" alt="{{ $follower->avatar }}" class="rounded-circle icon-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('users.follow.follower', $follower->id) }}" class="text-decoration-none text-dark fw-bold username">{{ $follower->user_name }}</a>
                            </div>
                            <div class="col-auto text-end">
                                @if ($follower->id != Auth::user()->id)
                                    @if (Auth::user()->followers()->where('id', $follower->id)->count() > 0)
                                        <form action="{{ route( 'users.follow.unfollow', $follower->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent p-0 btn-sm-unfollow">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow.follow', $follower->id) }}" method="post">
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
            <h3 class="text-muted text-center mt-5 mb-5">No Following Yet</h3>
        @endif
    </div>
</div>
@endsection
