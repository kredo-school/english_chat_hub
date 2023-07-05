@extends('layouts.admin-app')

@section('title', 'All Categories')
@section('subtitle', 'All Categories')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin_chatroom.css') }}">
@endsection

@section('content')
    <div class="content">

        <!-- Chatroom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
            <div class="create-event">
                <a type="button" href="{{ route('admin.chatrooms.categories.add') }}">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="ms-2">Create New Category</span>
                </a>
            </div>
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
            <table class="table table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th style="width: 200px">Meeting</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <a href="{{ route('admin.chatrooms.categories.show', $category->id) }}" class="text-start text-decoration-none">
                                    @if ($category->deleted_at)
                                        <span class="text-danger">{{ $category->name }}</span>
                                    @else
                                        {{ $category->name }}
                                    @endif
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center mx-auto"
                                    style="height: 3rem;width: 3rem;background-color: {{ $category->color }}">
                                    <img src="{{ asset('image/category/' . $category->icon) }}" alt="{{ $category->icon }}"
                                        style="width: 2rem;height:2rem;">
                                </div>
                            </td>
                            <td>{{ $category->meetings()->withTrashed()->count() }}</td>
                            <td>
                                @if ($category->deleted_at)
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
                                        <a type="button" class="dropdown-item"
                                            href="{{ Route('admin.chatrooms.categories.edit', $category->id) }}">Edit</a>
                                    </li>
                                    <li>
                                        @if ($category->deleted_at)
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#restore-{{ $category->id }}"
                                                class="dropdown-item text-success">
                                                Activate
                                            </button>
                                        @else
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $category->id }}"
                                                class="dropdown-item text-danger">
                                                Negate
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        {{-- include modal --}}
                        @include('admin.chatrooms.categories.modals.action')
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <span> showing {{ $all_categories->firstItem() }} to {{ $all_categories->lastItem() }} of {{ $all_categories->total() }} categories</span>
                <span class="float-end">{{ $all_categories->links() }}</span>
            </div>
        </div>

    </div>
@endsection
