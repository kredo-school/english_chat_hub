@extends('layouts.admin-app')

@section('title', 'All Meetings')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin_chatroom.css') }}">
@endsection

@section('content')
    <div class="content">
        
        <!-- Chatroom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
            <div class="status-group-sm">
                <ul>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-eye-slash text-danger icon-status"></i>
                        <span class="fs-4 pe-3">disable</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                        <span class="fs-4 pe-3">done</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                        <span class="fs-4 pe-3">in session</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-warning icon-status"></i>
                        <span class="fs-4 pe-3">stand by</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Table -->
        <div class="my-3">
            @if ($all_meetings->count() === 0)
                <div class="m-4 text-center">
                    <h1 class="my-5">There is No Meeting yet.</h1>
                </div>
            @else
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th style="max">Title</th>
                            <th>User</th>
                            <th style="max-width: 200px">Room</th>
                            <th style="max-width: 200px">Category</th>
                            <th style="max-width: 200px">Detail</th>
                            <th style="width: 200px">Member</th>
                            <th style="width: 100px">Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->id }}</td>
                                <td class="text-start text-capitalize">
                                    @if ($meeting->deleted_at)
                                        <span class="text-danger">{{ $meeting->title }}</span>
                                    @else
                                        {{ $meeting->title }}
                                    @endif

                                </td>
                                <td>{{ $meeting->user->user_name }}</td>
                                <td>{{ $meeting->room()->withTrashed()->first()->name }}</td>
                                <td>{{ $meeting->category()->withTrashed()->first()->name }}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#detail-{{ $meeting->id }}"
                                        class="btn btn-sm btn-outline-info">Detail</button>
                                </td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#member-{{ $meeting->id }}"
                                        class="btn btn-sm">
                                        <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                                    </button>
                                </td>
                                <td>
                                    @if ($meeting->deleted_at)
                                        <i class="fa-solid fa-eye-slash text-danger"></i>
                                    @else
                                        <i class="fa-solid fa-circle text-{{ $statusColor[$meeting->status_id] }}"></i>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a type="button" class="dropdown-item"
                                                href="{{ Route('admin.chatroom.meeting.edit', $meeting->id) }}">Edit</a>
                                        </li>
                                        <li>
                                            @if (!$meeting->room()->withTrashed()->first()->deleted_at && !$meeting->category()->withTrashed()->first()->deleted_at && $meeting->deleted_at)
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#restore-{{ $meeting->id }}"
                                                    class="dropdown-item text-success">
                                                    Activate
                                                </button>
                                            @endif
                                            @if (!$meeting->deleted_at)
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $meeting->id }}"
                                                    class="dropdown-item text-danger">
                                                    Negate
                                                </button>
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            {{-- INCLUEDE MODAL --}}
                            @include('admin.chatrooms.meetings.modals.action')
                            @include('admin.chatrooms.meetings.modals.detail')
                            @include('admin.chatrooms.meetings.modals.member')
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <hr>
        <div class="footer pt-3" style="max-height: 90px">
            {{ $all_meetings->links() }}
        </div>

    </div>
    @endsection
