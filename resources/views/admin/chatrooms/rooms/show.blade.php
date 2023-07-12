@extends('layouts.admin-app')

@section('title', 'Show Room')
@section('subtitle', 'Show Room')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin_chatroom.css') }}">
@endsection

@section('content')
    <div class="content">
        <!-- Chatroom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
            <a href="{{ route('admin.chatrooms.rooms.index') }}" class="d-inline text-decoration-none text-secondary fs-4">
                <i class="fa-solid fa-angle-left"></i> Back
            </a>
            <div class="status-group-sm">
                <ul>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-danger icon-status"></i>
                        <span class="fs-4 pe-3">unavailable</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                        <span class="fs-4 pe-3">available</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Table Head -->
        <div class="w-100 mb-0 pb-0 chatroom-table-head">
            <div class="container my-3 py-3 px-4 d-flex align-items-center border shadow-sm">
                <span class="fs-1"><strong class="fs-2">"{{ $room->name }}"</strong> detail</span>
                <span class="ms-3 fs-4">
                    @if ($room->deleted_at)
                        <i class="fa-solid fa-circle text-danger"></i>
                    @else
                        <i class="fa-solid fa-circle text-success"></i>
                    @endif
                </span>
                <div class="d-inline-block ms-auto">
                    @if ($room->zoomAccount)
                        <div class="dropdown">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Authenticated
                            </button>
                            <ul class="dropdown-menu">
                                <li><a data-bs-toggle="modal" data-bs-target="#delete-zoomAcount-{{ $room->id }}" class="dropdown-item">Delete Zoom Account</a></li>
                            </ul>
                            @include('admin.chatrooms.rooms.modals.zoom')
                        </div>
                    @elseif (!$room->deleted_at && !$room->zoomAccount)
                        <a href="{{ route('zoomOauthLink', $room->id) }}" class="btn btn-info">
                            <i class="fa-solid fa-plus"></i> Add Account
                        </a>
                    @endif
                </div>
            </div>
            @if ($room->zoomAccount)
                <div class="d-flex container mb-3 zoom-acount-info" style="gap: 1rem;">
                    <div class="py-2 col-3 text-white ps-2" style="background-color: var(--gray);">Account Name</div>
                    <div class="py-2 col ps-2" style="background-color: var(--li-gray);">{{ $room->zoomAccount->name }}
                    </div>
                </div>
                <div class="d-flex container mb-3" style="gap: 1rem;">
                    <div class="py-2 col-3 text-white ps-2" style="background-color: var(--gray);">Email</div>
                    <div class="py-2 col ps-2" style="background-color: var(--li-gray);">{{ $room->zoomAccount->email }}
                    </div>
                </div>
            @endif


            <div class="d-flex justify-content-between container">
                <div class="py-1 d-inline px-2 h4">
                    {{ $room->meetings->count() }} {{ $room->meetings->count() === 1 ? 'Meeting' : 'Meetings' }}
                </div>

                <!-- Status Bar -->
                <div class="d-inline-flex justify-content-end align-items-center">
                    <div class="pe-3 d-flex align-items-center">
                        <i class="fa-solid fa-circle text-success me-2"></i> in session
                    </div>
                    <div class="pe-3 d-flex align-items-center">
                        <i class="fa-solid fa-circle text-warning me-2"></i> stand-by
                    </div>
                    <div class="pe-3 d-flex align-items-center">
                        <i class="fa-solid fa-circle text-secondary me-2"></i> done
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-eye-slash text-danger me-2"></i> disable
                    </div>
                </div>

            </div>
        </div>

        <!-- Table Body -->
        @include('admin.chatrooms.components.meetingList')
    </div>
@endsection
