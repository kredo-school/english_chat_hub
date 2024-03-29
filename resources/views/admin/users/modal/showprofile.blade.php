<div class="modal fade" id="show-profile-{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-dark">
            <div class="modal-body p-5">
                <h2 class="modal-title mb-3">User Profile</h2>
                <div class="my-5">
                    <p class="my-5">
                        @if($user->avatar)
                            <img src="/image/avatars/{{ $user->avatar }}" alt="{{$user->avatar}}" class="avatar img-thumbnail rounded-circle ">
                        @else
                            <i class="fa-solid fa-circle-user avatar-modal"></i>
                        @endif
                    </p>
                    <p class="my-3 ms-5 text-start fs-4">User Name: {{$user->user_name}}</p>
                    <p class="my-3 ms-5 text-start fs-4">Full Name: {{$user->full_name}}</p>
                    <p class="my-3 ms-5 text-start fs-4">Email: {{$user->email}}</p>
                    <p class="my-3 ms-5 text-start fs-4">Level: {{$user->level->name}}</p>
                    <p class="my-3 ms-5 text-start fs-4">Comment:<br>{{$user->comment}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
