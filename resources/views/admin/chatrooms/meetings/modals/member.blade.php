<div class="modal fade" id="member-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content position-relative">

            <div class="modal-header border-0 justify-content-center">
                <h4 class="mb-0 pb-0 text-capitalize fw-normal">
                    <strong>"{{ $meeting->title }}"</strong> members
                </h4>
            </div>

            <div class="modal-body pt-0 border-top border-dark">
                <div class="col-8 mx-auto overflow-auto">
                    <ul class="list-group list-group-flush">
                        @forelse ($meeting->joinMeetings as $user)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-5">
                                    @if ($user->avatar)
                                        <div class="avatar-wrap">
                                            <img src="/image/avatars/{{ $user->avatar }}" alt="{{ $user->avatar }}" class="avatar">
                                            <div class="level-wrap">
                                                <img src="{{ asset('image/level/' . $user->level->icon) }}"
                                                    alt="{{ $user->level->name }}" class="level-icon">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar-wrap">
                                            <i class="fa-solid fa-circle-user display-5"></i>
                                            <div class="level-wrap">
                                                <img src="{{ asset('image/level/' . $user->level->icon) }}"
                                                    alt="{{ $user->level->name }}" class="level-icon">
                                            </div>
                                        </div>
                                    @endif
                                    <span>
                                        @if ($meeting->user_id === $user->id)
                                            <i class="fa-solid fa-star"></i>
                                        @endif
                                        {{ $user->user_name }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="text-center mt-3">No users joined.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <button type="button" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0"></button>

        </div>
    </div>
</div>
