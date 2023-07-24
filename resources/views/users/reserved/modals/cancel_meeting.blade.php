<div class="modal fade" id="cancel_meeting-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-danger">

            <div class="modal-header border-danger">
                <h2 class="modal-title fs-3 fw-bold mx-auto text-danger pt-0">Confirmed detail</h2>
            </div>

            <div class="modal-body">
                <p class="h6 text-muted text-center">Cancel the meeting on <span class="text-danger fs-6 fw-bold">{{$meeting->title}}</span> ?</p>

                  <div class="buttons d-flex justify-content-center mt-4">
                        <button class="button btn-gray me-1" data-bs-dismiss="modal">No Cancel</button>
                        <form action="{{ route('users.meeting.cancel', $meeting->id) }}" method="POST">
                        @csrf
                            <button type="submit" class="button btn btn-danger btn-lg"><strong>Cancel</strong></button>
                        </form>
                  </div> 
            </div>

        </div>
    </div>
 </div>


