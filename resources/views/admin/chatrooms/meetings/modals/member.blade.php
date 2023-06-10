<div class="modal fade" id="member-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content position-relative">

            <div class="modal-header border-0 justify-content-center">
                <h1 class="mb-0 pb-0 text-capitalize">{{ $meeting->title }}</h1>
            </div>

            <div class="modal-body pt-0">
                <div class="border-bottom">
                    <div class="col-8 mx-auto">
                        <span class="text-white bg-secondary rounded-top px-2 py-1">
                            Members
                        </span>
                    </div>
                </div>
                <div class="col-8 mx-auto overflow-auto">
                    <ul class="list-group list-group-flush">
                        @forelse ($meeting->joinMeetings as $user)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-5">
                                    @if ($user->avatar)

                                    {{-- Change URL for background-image --}}
                                    <div class="rounded-circle border border-danger d-flex align-items-center justify-content-center position-relative"
                                    style="height: 3rem;width: 3rem;background-image: url('#');background-size: cover;background-repeat: no-repeat;background-position: center;">
                                            <div class="rounded-circle border border-danger d-flex align-items-center justify-content-center bg-white"
                                                style="height: 1.5rem;width: 1.5rem;position: absolute;bottom: -0.25rem;right: -0.5rem">
                                                <img src="{{ asset('image/level/' . $user->level->icon) }}"
                                                    alt="{{ $user->level->icon }}" style="height: 1rem;width: 1rem;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center position-relative"
                                            style="height: 3rem;width: 3rem;">
                                            <i class="fa-solid fa-circle-user text-danger display-5"></i>
                                            <div class="rounded-circle border border-danger d-flex align-items-center justify-content-center bg-white"
                                                style="height: 1.5rem;width: 1.5rem;position: absolute;bottom: -0.25rem;right: -0.5rem">
                                                <img src="{{ asset('image/level/' . $user->level->icon) }}"
                                                    alt="{{ $user->level->icon }}" style="height: 1rem;width: 1rem;">
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
