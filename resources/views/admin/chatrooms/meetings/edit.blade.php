@extends('layouts.admin-app')

@section('title', 'Edit Meeting')

@section('content')
    <div class="content">

        <div class="col-6 mx-auto event-form pt-0">
            <h1 class="text-center">Edit Meeting</h1>
            <form action="{{ route('admin.chatrooms.meetings.update', $meeting->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="my-4 form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $meeting->title) }}">
                    {{-- ERROR --}}
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 row">
                    <div class="col-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control"
                            value="{{ old('date', $meeting->date) }}">
                        {{-- ERROR --}}
                        @error('date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label for="start-at" class="form-label">Start At</label>
                        <div class="input-group">
                            <input type="text" name="start_at" id="start-at" class="form-control text-end"
                                value="{{ old('start_at', $meeting->start_at) }}">
                            <span class="input-group-text"> : 00</span>
                            {{-- ERROR --}}
                            @error('start_at')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="room-id" class="form-label">Room</label>
                    <select name="room_id" id="room-id" class="form-select">
                        @foreach ($all_rooms as $room)
                            @if ($room->id === $meeting->room_id)
                                <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                            @else
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- ERROR --}}
                    @error('room_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category-id" class="form-label">Category</label>
                    <select name="category_id" id="category-id" class="form-select">
                        @foreach ($all_categories as $category)
                            @if ($category->id === $meeting->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- ERROR --}}
                    @error('category_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="level-id" class="form-label">Level</label>
                    <select name="level_id" id="level-id" class="form-select">
                        @foreach ($all_levels as $level)
                            @if ($level->id === $meeting->level_id)
                                <option value="{{ $level->id }}" selected>{{ $level->name }}</option>
                            @else
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- ERROR --}}
                    @error('level_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-end">
                    <a href="{{ route('admin.chatrooms.meetings.index') }}" class="button btn-gray">Cancel</a>
                    <button type="submit" class="button btn-orange">Save</button>
                </div>

            </form>
        </div>
        
    </div>
@endsection
