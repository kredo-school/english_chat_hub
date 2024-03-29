@extends('layouts.admin-app')

@section('title', 'All Meetings')
@section('subtitle', 'All Meetings')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin_chatroom.css') }}">
@endsection

@section('content')
    <div class="content">

        <!-- Chatroom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Sort Buttons -->
        <div class="d-flex justify-content-between sort-buttons">
            <!-- Status Sort -->
            <div class="text-decoration-none text-secondary fs-4">
                <div class="dropdown d-inline">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Sort by
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.chatrooms.meetings.result', 'stand_by') }}"
                                class="text-secondary text-decoration-none dropdown-item">stand by</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.chatrooms.meetings.result', 'in_session') }}"
                                class="text-secondary text-decoration-none dropdown-item">in session</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.chatrooms.meetings.result', 'done') }}"
                                class="text-secondary text-decoration-none dropdown-item">done</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.chatrooms.meetings.result', 'negate') }}"
                                class="text-danger text-decoration-none dropdown-item">negate</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- hide toggler -->
            <div class="form-check form-switch d-flex align-items-center gap-2 fs-4 float-end">
                <input class="float-none form-check-input" type="checkbox" role="switch" id="hide-switch">
                <label class="form-check-label" for="hide-switch">Hide negated</label>
            </div>
        </div>

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
            <div class="status-group-sm">
                <ul class="status-ul">
                    <li class="ms-1">
                        <span class="fs-4 pe-3">
                            <i class="fa-solid fa-eye-slash text-danger icon-status"></i>disable
                        </span>
                    </li>
                    <li class="ms-1">
                        <span class="fs-4 pe-3">
                            <i class="fa-solid fa-circle text-secondary icon-status"></i>
                            done
                        </span>
                    </li>
                    <li class="ms-1">
                        <span class="fs-4 pe-3">
                            <i class="fa-solid fa-circle text-success icon-status"></i>
                            in session
                        </span>
                    </li>
                    <li>
                        <span class="fs-4 pe-3">
                            <i class="fa-solid fa-circle text-warning icon-status"></i>
                            stand by
                        </span>
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
                            <th style="max-width: 200px">START</th>
                            <th style="width: 200px">Member</th>
                            <th style="width: 100px">Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_meetings as $meeting)
                            <tr
                                class="meeting-tr {{ $meeting->deleted_at ? 'deleted': ''}}">
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
                                <td>{{ date('Y-m-d G:i', strtotime($meeting->date . $meeting->start_at)) }}~</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#member-{{ $meeting->id }}" class="btn btn-sm">
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
                                                href="{{ route('admin.chatrooms.meetings.edit', $meeting->id) }}">Edit</a>
                                        </li>
                                        <li>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#detail-{{ $meeting->id }}"
                                                class="btn btn-sm btn-outline-info dropdown-item">Detail</button>
                                        </li>
                                        <li>
                                            @if (
                                                !$meeting->room()->withTrashed()->first()->deleted_at &&
                                                    !$meeting->category()->withTrashed()->first()->deleted_at &&
                                                    $meeting->deleted_at)
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#restore-{{ $meeting->id }}"
                                                    class="dropdown-item text-success">
                                                    Activate
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#forceDelete-{{ $meeting->id }}"
                                                    class="dropdown-item text-danger">
                                                    Force Delete
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
        <div class="row">
            <div class="col-12">
                <span> showing {{ $all_meetings->firstItem() }} to {{ $all_meetings->lastItem() }} of
                    {{ $all_meetings->total() }} meetings</span>
                <span class="float-end">{{ $all_meetings->links() }}</span>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#hide-switch').click(function() {
                if ($(this).prop('checked')) {
                    $('.deleted').hide();
                } else {
                    $('.deleted').show();
                }
            });
        });
    </script>
@endsection
