@if(isset($user))
    <div class="profile">
        <h2 class="display-5">PROFILE</h2>
        <div class="avatar mx-auto">
            @if($user->avatar)
              <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="avatar-md">
            @else
            <i class="fa-solid fa-user text-secondary avatar-md text-center"></i>
            @endif
        </div>

        <div class="profile-user mt-2">
          <div class="avatar-level">
            <img src="{{ asset('image/level/beginner.png')}}" alt="" width="20px" height="25px" class="">
          </div>
          <h3 class="username fs-3">{{ $user->user_name }}</h3>
        </div>
            <p class="fs-4">{{ $user->comment }}</p>
        <div class="edit-button mt-2">  
            <a href="{{ route('users.profile.edit') }}" class="btn btn-light edit-btn mb-3 text-warning">EDIT</a> 
        </div>  
    </div>
@endif