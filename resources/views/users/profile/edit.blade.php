@extends('layouts.app')

@section('content')
  <div class="container w-50 mt-5">
      <div class="form" id="form">
          <form action="{{ route('users.profile.update') }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

            <h3 class="edit-title">Edit Profile</h3>
              <div class="edit-avatar mx-auto">
                @if($user->avatar)
                <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="avatar-md">
                @else
                    <i class="fa-solid fa-user text-secondary text-center avatar-md"></i>
                @endif
              </div>

              <div class="row" id="edit-row">
                  <div class="col">
                    <input type="file" name="avatar" class="form-control mt-4" aria-describedby="avatar-info">
                    <div class="form-text" id="avatar-info">
                      Acceptable formats: jpeg, jpg, png, gif only <br>
                      Max file size is 1048 KB
                    </div>
                    @error('avatar')
                      <p class="text-danger small">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col">
                      <select name="level_id" id="" class="form-control mt-4">
                          @foreach($all_levels as $level)
                            @if($level->id === $user->level_id)
                              <option value="{{ $level->id }}" selected>{{ $level->name }}</option>
                            @else
                              <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endif
                          @endforeach
                      </select>
                      
                  </div>
              </div>
              
              <label for="user_name" class="form-label mt-2">Username</label>
              <input name="user_name" class="form-control" type="text" value="{{ old('user_name', $user->user_name)}}" placeholder="username">
              @error('user_name')
                <p class="text-danger small">{{ $message }}</p>
              @enderror

              <label for="comment" class="form-label mt-2">Comment</label>
              <input name="comment" class="form-control" type="text" value="{{ old('comment', $user->comment) }}" placeholder="comment">
              @error('comment')
                <p class="text-danger small">{{ $message }}</p>
              @enderror

              <label for="email" class="form-label mt-2">Email</label>
              <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" value="{{ old('email', $user->email) }}" placeholder="chathub@gmail.com">
              @error('email')
                <p class="text-danger small">{{ $message }}</p>
              @enderror

              <button class="btn btn-orange mt-2" id="edit-btn">EDIT</button>

            </form>
      </div>
  </div>
@endsection