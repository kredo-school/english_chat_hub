<div class="body">
    <div class="user-avatar">
        @if ($user->avatar)
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="avatar-md">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
              
    <div class="profile-user mt-2">
        <div class="about-user">
            <div class="user-detail">
                <div class="avatar-level">
                <img src="{{ asset('image/level/' . $user->level->icon) }}" class="icon-lg mx-auto" alt="{{ $user->level->name }}">
                </div>
                <h3 class="username">{{ $user->full_name }}</h3>

                <div class="edit-button">
                    @if (Auth::user()->id === $user->id)
                        <a href="{{ route('users.profile.edit') }}" class="btn btn-light edit-btn mb-3 text-warning">Edit Profile</a> 
                    @else
                        @if ($user->following()->where('id', Auth::user()->id)->exists())
                            <form action="{{ route('users.follow.unfollow', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light edit-btn mb-3 text-warning">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('users.follow.follow', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-light edit-btn mb-3 text-warning">Follow</button>
                            </form>
                        @endif  
                    @endif 
                </div>
            </div>
            <div class="count-users">
                <a href="{{ route('users.follow.follower', $user->id) }}" class="following">
                    <strong>{{ $user->following()->count() }}</strong> {{ $user->following()->count() == 1 ? 'follower' : 'followers'  }}
                </a>
                <a href="{{ route('users.follow.following', $user->id) }}" class="follower">
                    <strong>{{ $user->followers()->count() }}</strong> following
                </a>
            </div>
            <p class="comment">{{ $user->comment }}</p>
        </div>
    </div>
        


</div>
        
