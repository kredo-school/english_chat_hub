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
                        <h1 class="text-center display-5 fw-bold py-3">Edit Chat Room</h1>
                    </div>

                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('users.meeting.update', $meeting->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="col-10 mx-auto">

                                <!-- Meeting Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Meeting Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $meeting->title) }}">

                                    @error('title')
                                      <div class="text-danger small" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror                   
                                </div>

                                <!-- Date -->
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $meeting->date) }}">

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
                                        <input type="text" name="start_at" id="start-at" class="form-control" value="{{ old('start_at', date('G',strtotime($meeting->start_at))) }}"><span class="input-group-text"> : 00</span>
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
                                          @foreach($all_rooms as $room)
                                              <option value="{{ $room->id }}" {{ old('room_id', $meeting->room_id) == $room->id ? 'selected' : '' }}> {{ $room->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                  </div>
                                </div>

                                <!-- Level -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="level_id" class="form-label">Level</label>
                                        <select name="level_id" class="form-control">
                                          @foreach($all_levels as $level)                               
                                            <option value="{{ $level->id }}" {{ old('level_id', $meeting->level_id) == $level->id ? 'selected' : '' }}> {{ $level->name }}
                                            </option>
                                          @endforeach
                                        </select>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" class="form-control">
                                            @foreach($all_categories as $category)                     
                                              <option value="{{ $category->id }}" {{ old('category_id', $meeting->category_id) == $category->id ? 'selected' : '' }}> {{ $category->name }}
                                              </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- button -->
                                <div class="buttons mt-5">
                                    <a href="{{ route('users.reserved.show.details') }}" class="button btn-gray">Cancel</a>
                                    <button class="button btn-orange">SAVE</button>
                                </div> 
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
