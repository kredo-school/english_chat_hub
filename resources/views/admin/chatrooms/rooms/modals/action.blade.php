<!-- Delete -->
<div class="modal fade" id="delete-{{ $room->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content border-danger">
            <form action="{{ route('admin.chatrooms.rooms.delete', $room->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-header border-danger">
                    <h1 class="h3 text-center text-danger w-100">
                        <i class="fa-solid fa-eye-slash"></i> Negate
                    </h1>
                </div>

                <div class="modal-body pb-0">
                    <div class="col-8 mx-auto">
                        <div class="row">
                            <div class="col-3">ID</div>
                            <div class="col">: {{ $room->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">NAME</div>
                            <div class="col">: {{ $room->name }}</div>
                        </div>
                        <p class="text-danger mb-0 mt-1">Are you sure to negate this room?</p>
                        @if ($room->meetings->count() != 0)
                            <p class="text-danger mb-0 mt-1">
                                <i class="fa-solid fa-triangle-exclamation"></i> {{ $room->meetings->count() }}
                                {{ $room->meetings->count() === 1 ? 'Meeting' : 'Meetings' }} will also negate.
                            </p>
                        @endif
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
<div class="modal fade" id="restore-{{ $room->id }}">
    <div class="modal-dialog border-success">
        <div class="modal-content border-success">
            <form action="{{ route('admin.chatrooms.rooms.restore', $room->id) }}" method="post">
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
                            <div class="col">: {{ $room->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">NAME</div>
                            <div class="col">: {{ $room->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-3">DELETED</div>
                            <div class="col">: {{ $room->deleted_at }}</div>
                        </div>
                        <p class="text-danger text-center mb-0 mt-1">Are you sure to activate this room?</p>
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
