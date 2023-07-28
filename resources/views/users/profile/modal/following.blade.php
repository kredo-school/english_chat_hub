<div class="modal fade" id="following-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">
            <div class="modal-header">
                <button type="button" class="btn-close float-end me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title text-align-center my-3 fw-bold">Following</h1>
            </div>
            <div class="modal-body">
                @if ($followers->isNotEmpty())
                    @foreach ($user->followers as $follower)
                        <div class="row align-items-center m-3 users">
                            <div class="col-md-3">
                                <a href="{{ route('users.follow.profile-page', $follower->id) }}">
                                    @if ($follower->avatar)
                                        <img src="{{ asset('storage/avatars/' . $follower->avatar) }}" alt="{{ $follower->avatar }}" class="rounded-circle icon-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-2 ps-0 text-truncate">
                                <a href="{{ route('users.follow.profile-page', $follower->id) }}" class="text-decoration-none text-dark fw-bold username">{{ $follower->user_name }}</a>
                            </div>
                            <div class="col-md-5 text-end">
                                @if ($follower->id != Auth::user()->id)
                                    @if (Auth::user()->followers()->where('id', $follower->id)->count() > 0)
                                        <form action="{{ route( 'users.follow.unfollow', $follower->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent p-0 btn-sm-unfollow">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow.follow', $follower->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="border-0 bg-transparent p-0 btn-sm-follow">Follow</button>
                                        </form>
                                    @endif  
                                @endif
                            </div>
                        </div>
                    @endforeach
                        
                @else
                    <h3 class="text-muted text-center mt-5 mb-5">No Following Yet</h3>
                @endif
            </div>
        </div>
    </div>
</div>

