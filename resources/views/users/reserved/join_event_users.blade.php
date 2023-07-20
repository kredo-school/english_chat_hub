@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="form w-50 mx-auto p-5">
            <a href="javascript:void(0);" onclick="goBack();"><i
                    class="fa-solid fa-xmark fa-pull-right mt-3 me-4 text-secondary"></i></a>
            <h2 class="display-5">{{ $event->theme }}</h2>
            <div class="line">
                <p class="join-event-members mb-0 px-4">
                    <b>{{ $event->joinEvents->count() }}{{ $event->joinEvents->count() == 1 ? 'member' : 'members' }}</b>
                </p>
            </div>
            <hr class="m-0 text-secondary">

            @forelse($event->joinEvents as $participant)
                <div class="join-users my-2 mx-auto">
                    <div class="join-user">
                        @if ($participant->user_id && $participant->user->avatar)
                            <img src="{{ asset('storage/avatars/' . $participant->user->avatar) }}" class="rounded-circle"
                                id="avatar-sm">
                        @else
                            <i class="fa-solid fa-circle-user fa-2xl text-secondary text-center"></i>
                        @endif
                    </div>
                    @if($participant->user_id && Auth::user()->id === $participant->user->id)
                        <a href="{{ route('users.follow.follower', $participant->user->id) }}" class="text-decoration-none category-item h5 my-0 ms-3 text-secondary">
                            {{ $participant->user->user_name }}
                        </a>
                    @elseif ($participant->user_id && $participant->user->id)
                        <button data-bs-toggle="modal" data-bs-target="#other-event-member{{ $participant->user->id }}"
                            class="border-0 bg-white">
                            <div class="category-item h5 my-0 ms-3 text-secondary">{{ $participant->user->user_name }}</div>
                        </button>
                        {{-- Modal --}}
                        <div class="modal fade" id="other-event-member{{ $participant->user->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content border border-2 border-warning">
                                    <div class="modal-body">
                                            <div class="modal-title text-center fs-2 my-3 fw-bold">OTHER MEMBER</div>
                                        <div class="avatar mx-auto">
                                            @if ($participant->user->avatar)
                                                <img src="{{ asset('storage/avatars/' . $participant->user->avatar) }}"
                                                    alt="" class="avatar-md">
                                            @else
                                                <i class="fa-solid fa-circle-user fa-2xl text-secondary text-center"></i>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            @if ($participant->user_id)
                                                <img src="{{ asset('image/level/' . $participant->user->level->icon) }}"
                                                    class="avatar-level mx-auto"
                                                    alt="{{ $participant->user->level->name }}">
                                                <span class="h3 mx-auto"
                                                    id="username">{{ $participant->user->user_name }}</span>
                                            @endif
                                        </div>
                                        @if ($participant->user_id && $participant->user->comment)
                                            <p class="fs-5 mt-1 mb-0 text-center">{{ $participant->user->comment }}</p>
                                        @else
                                            <p class="fs-6 mt-1 mb-0 text-center">---No comment---</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="category-item h5 my-0 ms-3 text-secondary">{{ $participant->name }}</p>
                    @endif
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
