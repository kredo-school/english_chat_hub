<div class="modal fade" id="delete-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">

            <div class="modal-header border-danger">
                <h2 class="modal-title fs-3 fw-bold mx-auto text-danger pt-0">Confirmed detail</h2>
            </div>

              <div class="modal-body">
                <p class="h6 text-muted text-center">Delete the meeting on <span class="text-danger fs-6 fw-bold">{{$meeting->title}}</span> ?</p>
                    <div class="buttons d-flex justify-content-center mt-4">
                        <form action="{{ route('users.meeting.delete', $meeting->id ) }}" method="post">
                        @csrf
                        @method('DELETE')
                          <button class="button btn-gray me-1" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="button btn-orange ms-1">Delete</button>
                        </form>
                    </div> 
              </div>

        </div>
    </div>
</div>
              
