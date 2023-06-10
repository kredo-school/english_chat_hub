<!-- Delete -->
<div class="modal fade" id="delete-{{ $meeting->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content border-danger">
            <form action="{{ Route('admin.chatroom.meeting.delete', $meeting->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-header border-danger">
                    <h1 class="h3 text-center text-danger w-100">
                        <i class="fa-solid fa-eye-slash"></i> Negate
                    </h1>
                </div>

                <div class="modal-body pb-0">
                    <div class="col-6 mx-auto">
                        <div class="row">
                            <div class="col-3">ID</div>
                            <div class="col">: {{ $meeting->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">TITLE</div>
                            <div class="col">: {{ $meeting->title }}</div>
                        </div>
                        <p class="text-danger text-center mb-0 mt-1">Are you sure to negate this meeting?</p>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary ms-auto">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">Negate</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Restore -->
<div class="modal fade" id="restore-{{ $meeting->id }}">
    <div class="modal-dialog border-success">
        <div class="modal-content border-success">
            <form action="{{ Route('admin.chatroom.meeting.restore', $meeting->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="modal-header border-success">
                    <h1 class="h3 text-center text-success w-100">
                        <i class="fa-solid fa-eye"></i> Activate
                    </h1>
                </div>

                <div class="modal-body pb-0">
                    <div class="col-6 mx-auto">
                        <div class="row">
                            <div class="col-3">ID</div>
                            <div class="col">: {{ $meeting->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">TITLE</div>
                            <div class="col">: {{ $meeting->title }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">DELETED</div>
                            <div class="col">: {{ $meeting->deleted_at }}</div>
                        </div>
                        <p class="text-danger text-center mb-0 mt-1">Are you sure to activate this meeting?</p>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary ms-auto">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">Activate</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
