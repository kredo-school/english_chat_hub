<!-- Delete -->
<div class="modal fade" id="delete-{{ $meeting->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body p-3 text-center">
                <h1 class="modal-title my-5 text-danger">Negate meeting?</h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation text-danger modal-exclamation"></i></p>
                    <p class="my-5">
                        Are you sure you want to delete <br>
                        <span class="text-danger fs-3 fw-bold"> "{{ $meeting->title }}"</span>?
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.chatrooms.meetings.delete', $meeting->id) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Negate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Restore -->
<div class="modal fade" id="restore-{{ $meeting->id }}">
    <div class="modal-dialog border-success">
        <div class="modal-content border border-2 border-success">
            <div class="modal-body p-3 text-center">
                <h1 class="modal-title my-5 text-success">Activate meeting?</h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation text-success modal-exclamation"></i></p>
                    <p class="my-5">
                        Are you sure you want to activate <br>
                        <span class="text-success fs-3 fw-bold"> "{{ $meeting->title }}"</span>?
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ Route('admin.chatrooms.meetings.restore', $meeting->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="btn btn-outline-success btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
