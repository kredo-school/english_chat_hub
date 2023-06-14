@extends('layouts.admin-app')

@section('title', 'Show Category')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin_chatroom.css') }}">
@endsection

@section('content')
    <div class="content">

        <!-- Chatrom Bar -->
        @include('admin.chatrooms.components.bar')

        <!-- Status Bar -->
        <div class="serch-status position-relative" style="min-height: 38px;height: auto;">
            <a href="{{ route('admin.chatroom.category.index') }}" class="d-inline text-decoration-none text-secondary fs-4">
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
            <div class="container my-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="d-flex justify-content-center align-items-center" style="background-color: {{ $category->color }};width: 5rem;height: 5rem;">
                            <img src="{{ asset('image/category/' . $category->icon) }}" alt="{{ $category->icon }}" style="width: 3rem;height: 3rem;">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <span class="fs-1"><strong class="fs-2">"{{ $category->name }}"</strong> detail</span>
                            <span class="ms-3 fs-4">
                                @if ($category->deleted_at)
                                <i class="fa-solid fa-circle text-danger"></i>
                                @else
                                <i class="fa-solid fa-circle text-success"></i>
                                @endif
                            </span>
                        </div>
        
                        <div class="row">
                            <p class="py-0">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between container">
                <div class="py-1 d-inline px-2 h4">
                    {{ $category->meetings->count() }} {{ $category->meetings->count() === 1 ? 'Meeting' : 'Meetings' }}
                </div>

                <!-- Status Bar -->
                <div class="d-inline-flex justify-content-end align-items-center">
                    <div class="pe-3 d-flex align-items-center">
                        <i class="fa-solid fa-circle text-success me-2"></i> in session
                    </div>
                    <div class="pe-3 d-flex align-items-center">
                        <i class="fa-solid fa-circle text-warning me-2"></i> stand-by
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle text-secondary me-2"></i> done
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Body -->
        @include('admin.chatrooms.components.meetingList')
        
    </div>
    @endsection
