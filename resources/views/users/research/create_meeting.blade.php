@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <h1 class="text-center display-5 fw-bold py-3">Create Chat Room</h1>
                    </div>

                    <div class="card-body pt-0">
                        <form method="post" action="{{ route('users.meeting.store') }}">
                            @csrf
                            <div class="col-10 mx-auto">

                                <!-- Meeting Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Meeting Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Title" value="">

                                    @error('title')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Date -->
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="">

                                    @error('date')
                                        <div class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                  <!-- Start Time -->
                                  <div class="col-3">
                                      <label for="start-at" class="form-label">Start At</label>
                                      <div class="input-group">
                                        <input type="text" name="start_at" id="start-at" class="form-control" value="">
                                        <span class="input-group-text"> : 00</span>
                                      </div>

                                      @error('start_at')
                                          <div class="text-danger small" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </div>
                                      @enderror
                                  </div>
                                  
                                  <!-- Room -->
                                  <div class="col-5">
                                    <label for="room_id" class="form-label">Room</label>
                                        <select name="room_id" class="form-control">
                                          <option value="" selected>--Select Room--</option>
                                            @foreach($all_rooms as $room)
                                              <option value="{{ $room->id }}">{{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                  </div>
                                </div>

                                <!-- Level -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="level_id" class="form-label">Level</label>
                                        <select name="level_id" class="form-control">
                                          <option value="" selected>--Select Level--</option>
                                            @foreach($all_levels as $level)
                                              <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" class="form-control">
                                          <option value="" selected>--Select Category--</option>
                                            @foreach($all_categories as $category)
                                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- button -->
                                <div class="buttons mt-5">
                                    <a href="{{ route('users.top') }}" class="button btn-gray">Cancel</a>
                                    <button type="submit" class="button btn-orange"><i class="fa-solid fa-plus"></i>Create</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
