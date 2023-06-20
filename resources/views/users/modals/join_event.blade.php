{{-- Join Event Modal --}}
<div class="modal fade" id="join-event-{{$event->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-1">
            <div class="modal-header border-secondary">
                <h2 class="modal-title text-secondary">
                    Confirm detail
                </h2>
            </div>
            <div class="modal-body">
                <p class="h6 text-muted text-center">Join an event on {{$event->date}} at {{$event->location}}?</p>
            </div>
            <div class="modal-footer border-0 mb-5">
                <form action="#" method="post">
                    @csrf
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-orange">Join</button>    
                </form>
            </div>
        </div>
    </div>
</div>