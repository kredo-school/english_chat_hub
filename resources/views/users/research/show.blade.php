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
                        <a href="{{ route('users.top') }}" class="text-secondary"><i
                                class="fa-solid fa-angles-left fa-lg"></i> back</a>
                    </div>
                    <h2 class="display-5 mb-3 pt-0">{{ $category->name }}</h2>
                    {{-- create meeting button --}}
                    <div class="ms-5 mb-2">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#create-meeting" class="text-secondary"
                            title="Create Meeting">
                            <i class="fa-solid fa-circle-plus fs-5"></i>
                            <span class="ms-2 fs-6">Create New Meeting</span></a>
                    </div>
                    @include('users.research.modals.create_meeting')

                    @forelse($all_meetings as $meeting)
                        <div class="category-room mx-auto mb-2">
                            <table class="table table-borderless mb-0 align-middle row">
                                <tr>
                                    <td class="col-3">
                                        {{ $meeting->date }}&emsp;{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }}〜
                                    </td>
                                    <td class="col-1">
                                        <img src="{{ asset('image/level/' . $meeting->level->icon) }}" class="icon-sm"
                                            alt="{{ $meeting->level->name }}">
                                    </td>
                                    <td class="col" style="width: 450px">
                                        {{ mb_substr($meeting->title, 0, 50) }}{{ mb_strlen($meeting->title) > 50 ? '...' : '' }}
                                    </td>
                                    <td class="col-1">
                                        <a href="{{ route('users.reserved.show.users', ['meeting' => $meeting->id]) }}"
                                            class="text-muted">
                                            <i class="fa-solid fa-users"></i>
                                        </a>
                                    </td>
                                    <td class="col-1">
                                        <a class="text-muted" data-bs-toggle="modal"
                                            data-bs-target="#reservation-{{ $meeting->id }}">
                                            <i class="fa-solid fa-circle-plus fa-xl text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @include('users.research.modals.reservation')
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
        const availableRooms = {!! json_encode($availableRooms) !!};
    </script>
    <script src="{{ mix('js/create_meeting.js') }}"></script>
    <script src="{{ asset('js/count-text.js') }}"></script>
@endsection
