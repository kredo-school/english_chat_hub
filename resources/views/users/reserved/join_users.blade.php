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
                
                <button data-bs-toggle="modal" data-bs-target="#other-member{{ $user->id }}" class="border-0 bg-white">
                    <div class="category-item h5 my-0 ms-3 text-secondary">{{ $user->user_name }}</div>
                </button>

                {{-- Modal --}}
                <div class="modal fade" id="other-member{{ $user->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content border border-2 border-warning">

                            <div class="modal-body">
                                <div class="modal-title text-center fs-2 my-3 fw-bold">OTHER MEMBER</div>
                                    <div class="avatar mx-auto">
                                        @if($user->avatar)
                                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="avatar-md">
                                        @else
                                        <i class="fa-solid fa-circle-user fa-2xl text-secondary text-center"></i>
                                        @endif
                                    </div>
                                    {{-- show user's level icon --}}
                                    <div class="text-center">
                                        <img src="{{ asset('image/level/' . $user->level->icon) }}" class="avatar-level mx-auto" alt="{{ $user->level->name }}">
                                        <span class="h3 mx-auto" id="username">{{ $user->user_name }}</span>                                      
                                    </div>
                                    @if($user->comment)
                                        <p class="fs-5 mt-1 mb-0 text-center">{{ $user->comment }}</p>
                                    @else
                                        <p class="fs-6 mt-1 mb-0 text-center">---No comment---</p>
                                    @endif
                                    {{--using empty() --}}
                                    {{-- <p class="fs-5 mt-1 mb-0">{{ empty($user->comment) ? '---No comment---' : $user->comment }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
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