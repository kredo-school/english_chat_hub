@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="form w-50 mx-auto p-5">
    <a href="javascript:void(0);" onclick="goBack();"><i class="fa-solid fa-xmark fa-pull-right mt-3 me-4 text-secondary fa-lg"></i></a>
      <h2 class="display-5">{{ $meeting->category->name }}</h2>
        <p class="h5 mb-3" id="category-title">{{ $meeting->category->description }}</p>
            <div class="line">
                <p class="join-members mb-0 px-4"><b>{{ $meeting->joinMeetings->count() }}{{$meeting->joinMeetings->count() == 1 ? 'member':'members'}}</b></p>
            </div>
            <hr class="m-0 text-secondary">

            @forelse($all_users as $user)
            <div class="join-users my-2 mx-auto">
                <div class="join-user">
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}" class="rounded-circle" id="avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user fa-2xl text-secondary text-center"></i>
                    @endif
                </div>
                
                <a href="{{ route('users.follow.profile-page', $user->id)}}" class="category-item h5 my-0 ms-3 text-secondary text-decoration-none">{{ $user->user_name }}</a>
             </div>
             <hr class="m-0">
            @empty
                <p class="mt-2">No users reserved.</p>
            @endforelse  
            
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