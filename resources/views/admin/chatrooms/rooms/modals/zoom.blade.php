<!-- Delete -->
@if ($room->zoomAccount)
    <div class="modal fade" id="delete-zoomAcount-{{ $room->id }}">
        <div class="modal-dialog border-danger">
            <div class="modal-content border border-2 border-danger">
                <div class="modal-body p-3 text-center">
                    <h1 class="modal-title my-5 text-danger">Delete Zoom Account?</h1>
                    <div class="my-5">
                        <p><i class="fa-solid fa-triangle-exclamation text-danger modal-exclamation"></i></p>
                        <p class="my-5">
                            Are you sure you want to delete <br>
                            <span class="text-danger fs-3 fw-bold"> "{{ $room->zoomAccount->name }}"</span>?
                            @if ($room->meetings->count() != 0)
                                <p class="text-danger mb-0 mt-1">
                                    {{ $room->meetings->count() }}
                                    {{ $room->meetings->count() === 1 ? 'Meeting' : 'Meetings' }} will also be negated and deleted.
                                </p>
                            @endif
                        </p>
                    </div>
                    <div class="modal-footer border-0">
                        <form action="{{ route('admin.chatrooms.rooms.deleteZoomAccount', $room->id) }}" method="post"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
