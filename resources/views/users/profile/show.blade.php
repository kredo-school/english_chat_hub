@if(isset($user))
    <div class="profile">
        <a href="{{ route('users.follow.follower', $user->id) }}" class="p-0"><h2 class="display-7">PROFILE</h2></a>

        <div class="d-flex align-items-center justify-content-center mt-2">
            @if($user->avatar)
              <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="avatar-md">
            @else
              <i class="fa-solid fa-user text-secondary avatar-md d-inline-flex align-items-center justify-content-center"></i>
            @endif
        </div>

        <div class="profile-user mt-2">
          <div class="avatar-level">
            <img src="{{ asset('image/level/' . $user->level->icon) }}" class="icon-sm mx-auto" alt="{{ $user->level->name }}">
          </div>
          <h3 class="username fs-3">{{ $user->user_name }}</h3>
        </div>
            <p class="fs-4">{{ $user->comment }}</p>  
      </div>
@endif