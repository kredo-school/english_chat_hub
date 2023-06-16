<div class="modal fade" id="delete-event-{{$event->id}}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body p-3">
                <h1 class="modal-title my-5 text-danger">Delete event?</h1>
                <div class="my-5">
                    <p><i class="fa-solid fa-triangle-exclamation" style="color:red; font-size:8rem;"></i></p>
                    <p class="my-5">
                        Are you sure you want to delete <br>
                        <span class="text-danger fs-3 fw-bold"> "{{$event->theme}}"</span>?<br>
                        You can't undo this action.
                    </p>

                    <button type="button" class="my-5 btn button btn-gray" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <form action="{{ route('admin.destroyEvent',$event->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"class="my-5 btn button btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
