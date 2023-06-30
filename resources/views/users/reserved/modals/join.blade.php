<div class="modal fade" id="join-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">

              <div class=“modal-body”>
                <div class="modal-title text-center fs-2 my-3 fw-bold">Join “{{ $meeting->title }}”</div>
                   <h5 class="modal-text mx-auto mb-3">Category: {{ $meeting->category->name }}</h5>
                   <h5 class="modal-text mx-auto mb-3">Date: {{ $meeting->date }}</h5>
                   <h5 class="modal-text mx-auto mb-3">Time: {{ $meeting->start_at }}</h5>
                   <h5 class="modal-text mx-auto mb-3">Level: {{ $meeting->level->name }}</h5> 
              </div>

              <div class="buttons mt-5 mb-3 text-center">
                <button class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                <button type="" class="button btn-orange">Join</button>
              </div> 

        </div>
     </div>
</div>