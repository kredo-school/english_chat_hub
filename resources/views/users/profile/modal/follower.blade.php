
<div class="modal fade" id="follower-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">
            <div class="modal-header">
                <button type="button" class="btn-close float-end me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title text-align-center my-3 fw-bold">Followers</h1>
            </div>
            <div class="modal-body ms-3 me-3">
                @if ($following->isNotEmpty())
                    @foreach ($user->following as $following )
                        <div class="row align-items-center-mt-3 users">
                            <div class="col-md-3">
                                @if ($following->avatar)
                                    <img src="{{ asset('storage/avatars/' . $following->avatar) }}" alt="{{ $following->avatar }}" class="rounded-circle icon-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </div>
                            <div class="col-md-2 text-truncate">
                                <a href="{{ route('users.follow.profile-page', $following->id) }}" class="text-decoration-none text-dark fw-bold username">{{ $following->user_name }}</a>
                            </div>
                            <div class="col-md-5 text-end">
                                @if ($following->id != Auth::user()->id)  
                                    @if (Auth::user()->followers()->where('id', $following->id)->count() > 0)
                                        <form action="{{ route('users.follow.unfollow', $following->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent btn-sm-unfollow">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow.follow', $following->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="border-0 bg-transparent p-0 btn-sm-follow">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-muted text-center mt-5 mb-5">No Followers Yet.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
