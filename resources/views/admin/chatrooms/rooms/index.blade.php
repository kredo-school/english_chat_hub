@extends('layouts.admin-app')

@section('title', 'All Rooms')

@section('content')
    <div class="content">
        <!-- Chatroom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
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

        <!-- Table -->
        <div class="my-3">
            <table class="table align-middle table-striped text-center">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Name</th>
                        <th>Zoom</th>
                        <th style="width: 200px">Meeting</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>
                                <a href="{{ route('admin.chatrooms.rooms.show', $room->id) }}"
                                    class="text-decoration-none text-capitalize">
                                    {{ $room->name }}
                                </a>
                            </td>
                            <td>zoom_account_sample</td>
                            <td>{{ $room->Meetings()->withTrashed()->count() }}</td>
                            <td>
                                @if ($room->deleted_at)
                                    <i class="fa-solid fa-eye-slash text-danger"></i>
                                @else
                                    <i class="fa-solid fa-circle text-success"></i>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        @if ($room->deleted_at)
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#restore-{{ $room->id }}"
                                                class="dropdown-item text-success">
                                                Activate
                                            </button>
                                        @else
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $room->id }}"
                                                class="dropdown-item text-danger">
                                                Negate
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @include('admin.chatrooms.rooms.modals.action')
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>
    </div>
@endsection
