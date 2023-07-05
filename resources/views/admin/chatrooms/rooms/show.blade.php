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
        <div class="w-100 mb-0 pb-0" style="border-bottom: 2px solid var(--dark);">
            <div class="container mb-3 d-flex align-items-center">
                <span class="fs-1"><strong class="fs-2">"{{ $room->name }}"</strong> detail</span>
                <span class="ms-3 fs-4">
                    @if ($room->deleted_at)
                        <i class="fa-solid fa-circle text-danger"></i>
                    @else
                        <i class="fa-solid fa-circle text-success"></i>
                    @endif
                </span>
            </div>
            <div class="d-flex container mb-3" style="gap: 1rem;font-size;">
                <div class="py-2 col-3 text-white ps-2" style="background-color: var(--gray);">Account Name</div>
                <div class="py-2 col ps-2" style="background-color: var(--li-gray);">zoom_a</div>
            </div>
            <div class="d-flex container mb-3" style="gap: 1rem;">
                <div class="py-2 col-3 text-white ps-2" style="background-color: var(--gray);">Email</div>
                <div class="py-2 col ps-2" style="background-color: var(--li-gray);">sample@sample.com</div>
            </div>
            <div class="d-flex container mb-3" style="gap: 1rem;">
                <div class="py-2 col-3 text-white ps-2" style="background-color: var(--gray);">Password</div>
                <div class="py-2 col ps-2" style="background-color: var(--li-gray);">465f464R#</div>
            </div>
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
