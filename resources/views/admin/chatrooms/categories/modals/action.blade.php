<!-- Delete -->
<div class="modal fade" id="delete-{{ $category->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body p-3 text-center">
                <h1 class="modal-title my-5 text-danger">Negate category?</h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation text-danger modal-exclamation"></i></p>
                    <p class="my-5">
                        Are you sure you want to delete <br>
                        <span class="text-danger fs-3 fw-bold"> "{{ $category->name }}"</span>?
                        @if ($category->meetings->count() != 0)
                            <p class="text-danger mb-0 mt-1">
                                {{ $category->meetings->count() }}
                                {{ $category->meetings->count() === 1 ? 'Meeting' : 'Meetings' }} will also negate.
                            </p>
                        @endif
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.chatrooms.categories.delete', $category->id) }}" method="post"
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
<div class="modal fade" id="restore-{{ $category->id }}">
    <div class="modal-dialog border-success">
        <div class="modal-content border border-2 border-success">
            <div class="modal-body p-3 text-center">
                <h1 class="modal-title my-5 text-success">Activate category?</h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation text-success modal-exclamation"></i></p>
                    <p class="my-5">
                        Are you sure you want to activate <br>
                        <span class="text-success fs-3 fw-bold"> "{{ $category->name }}"</span>?
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.chatrooms.categories.restore', $category->id) }}" method="post"
                        class="d-inline">
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
