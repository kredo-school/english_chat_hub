<div class="modal fade" id="join-{{ $meeting->id }}">
    <div class="modal-dialog">
        <div class="modal-content border border-2 border-warning">

            <div class="modal-header border-0 mb-2">
                <h3 class="modal-title fs-3 fw-bold d-inline mx-auto">Join<br>“{{ $meeting->title }}”</h3>
            </div>

            <div class=“modal-body”>
                <h5 class="modal-text mx-auto mb-3">Category: {{ $meeting->category->name }}</h5>
                <h5 class="modal-text mx-auto mb-3">Date: {{ $meeting->date }}</h5>
                <h5 class="modal-text mx-auto mb-3">Time: {{ date('H:i', strtotime($meeting->start_at)) }}</h5>
                <h5 class="modal-text mx-auto mb-3">Level: {{ $meeting->level->name }}</h5>
            </div>

            @if ($meeting->meetingOpen())
                <div class="buttons mt-5 mb-3 text-center">
                    <button class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    @if ($meeting->zoomMeeting)
                        <a href="{{ $meeting->zoomMeeting->zoom_join_url }}" class="button btn-orange"
                            target="_blank">Join</a>
                    @else
                        <button type="" class="button btn-orange">Join</button>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
