<div class="modal fade" id="reservation-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">

            <div class=“modal-body”>
                <div class="modal-title text-center fs-2 my-3 fw-bold">Make a Reservation</div>
                   <p class="modal-text mx-auto mb-0 fs-4">{{ $meeting->category->name }}</p>
                   <p class="modal-text mx-auto mb-3 fs-4">〜{{ $meeting->title }}〜</p>
                   <p class="modal-text mx-auto mb-3">Date: {{ $meeting->date }}</p>
                   <p class="modal-text mx-auto mb-3">Time: {{ $meeting->start_at }}</p>
                   <p class="modal-text mx-auto mb-3">Level: {{$meeting->level->name }}</p>
                </div>

                {{-- button --}}
                <div class="buttons mt-5 mb-3 text-center">
                    <button class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="" class="button btn-orange">Reservation</button>
                </div> 
            </div>
        </div>
    </div>
</div>