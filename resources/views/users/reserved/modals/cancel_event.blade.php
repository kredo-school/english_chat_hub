<div class="modal fade" id="cancel-event-{{ $event->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">

            <div class="modal-body">
                <h1 class="modal-title text-center fs-2 my-3 fw-bold text-danger">Cancel Event?</h1>
                <div class="my-3">
                    <p><i class="fa-solid fa-triangle-exclamation" style="color:red; font-size:8rem;"></i></p>
                    <p class="my-3">
                        Are you sure you want to delete <br>
                        <span class="text-danger fs-6 fw-bold">{{ $event->theme }}</span>?<br>
                        You can't undo this action.
                    </p>

                    <div class="buttons d-flex justify-content-center">
                        <button class="button btn-gray me-1" data-bs-dismiss="modal">No Cancel</button>
                        <form action="{{ route('users.event.cancel', $event->id)}}" method="POST">
                        @csrf
                            <button type="submit" class="button btn btn-danger btn-lg"><strong>Cancel</strong></button>
                        </form>
                    </div> 
                </div>
            </div>

        </div>
    </div>
</div>
