@if($user->trashed() || $user->self_delete == 1)

{{-- Activate --}}
<div class="modal fade" id="activate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-body">
                <div class="my-5">
                    <h1 class="modal-title text-success my-5">
                        Activate this User?
                    </h1>
                    <p class="my-5">
                        <p><i class="fa-solid fa-user-check text-success" style="font-size:8rem;"></i></p>
                        <p class="my-5">
                        Are you sure you want to activate <br>
                        <span class="fs-4 fw-bold"> "{{$user->full_name}}"</span>?<br>
                        This user will be able to use our services again.
                    </p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.users.activate', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>

@else

{{-- Deactivate --}}
<div class="modal fade" id="deactivate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body p-3">
                <h1 class="modal-title my-5 text-danger">
                    Deactivate this User?
                </h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation" style="color:red; font-size:8rem;"></i></p>
                    <p class="my-5">
                        Are you sure you want to deactivate <br>
                        <span class="fs-4 fw-bold"> "{{$user->full_name}}"</span>?<br>
                        This user can't use our services <br> until you activate him/her again.
                    </p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif