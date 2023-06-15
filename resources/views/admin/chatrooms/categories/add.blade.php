@extends('layouts.admin-app')

@section('title', 'Create Category')

@section('content')
    <div class="content">

        <div class="col-6 mx-auto event-form pt-0">
            <h1 class="text-center">Create Categroy</h1>
            <form action="{{ route('admin.chatrooms.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="my-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        placeholder="Enter Name">
                    {{-- Error --}}
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-4 row">
                    <div class="col-6">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" name="color" id="color" class="form-control" value="{{ old('color') }}"
                            style="height: 38px;width:100%;">
                        {{-- Error --}}
                        @error('color')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="file" name="icon" id="icon" class="form-control">
                        {{-- Error --}}
                        @error('icon')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                    {{-- Error --}}
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-end">
                    <a href="{{ route('admin.chatrooms.categories.index') }}" class="button btn-gray">Cancel</a>
                    <button type="submit" class="button btn-orange">Create</button>
                </div>

            </form>
        </div>
        
    </div>
@endsection
