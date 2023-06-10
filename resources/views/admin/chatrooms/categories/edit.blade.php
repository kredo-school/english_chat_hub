@extends('layouts.admin-app')

@section('title', 'Edit Category')

@section('content')
    <div class="content">

        <div class="col-6 mx-auto event-form pt-0">
            <h1 class="text-center">Edit Categroy</h1>
            <form action="{{ route('admin.chatroom.category.update', $category->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="my-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $category->name) }}" placeholder="Enter Name">
                    {{-- Error --}}
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-4 row">
                    <label for="color" class="form-label">Icon Color</label>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="mx-auto form-control d-flex align-items-center justify-content-center rounded-0 mb-4"
                                style="width: 6rem;height: 6rem;background-color: {{ $category->color }}">
                                <img src="{{ asset('image/category/' . $category->icon) }}" alt="{{ $category->icon }}"
                                    style="width: 4rem;height: 4rem;">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <input type="color" name="color" id="color" class="form-control"
                                    value="{{ old('color', $category->color) }}" style="height: 38px;width:100%;">
                                {{-- Error --}}
                                @error('color')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="file" name="icon" id="icon" class="form-control">
                                {{-- Error --}}
                                @error('icon')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $category->description) }}</textarea>
                    {{-- Error --}}
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-end">
                    <a href="{{ route('admin.chatroom.category.index') }}" class="button btn-gray">Cancel</a>
                    <button type="submit" class="button btn-orange">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection
