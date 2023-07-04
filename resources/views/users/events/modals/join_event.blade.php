{{-- Join Event Modal for Auth::user() --}}
<div class="modal fade" id="join-event-{{$event->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-1">
            <div class="modal-header border-secondary">
                <h2 class="modal-title text-secondary">
                    Confirm detail
                </h2>
            </div>
            <div class="modal-body">
                <p class="h6 text-muted text-center">Join the event on {{$event->date}} at {{$event->location}}?</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('events.storeAuth', $event)}}" method="post" class="mt-0">
                    @csrf
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-orange">Join</button>  
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Cancel Event Modal for Auth::user() --}}
<div class="modal fade" id="cancel-event-{{$event->id}}">
    <div class="modal-dialog">
    
        <div class="modal-content border border-2 border-danger">
            <div class="modal-header border-danger">
                <h2 class="modal-title text-danger fs-3 fw-bold mx-auto">Confirmed detail</h2>
            </div>
            <div class="modal-body">
                <p class="h6 text-muted text-center">Cancel the event on {{$event->date}} at {{$event->location}}?</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('events.destroyAuthParticipant', $event->id)}}" method="post" class="mt-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button btn-gray">Cancel Event</button>  
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Success Modal --}}
@if (session('success'))
<div class="modal fade success-modal" id="join-event-result" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="join-event-result-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-box">
                    <div class="modal-text">
                        <h3 class="h5 success-title mb-3">Looking forward to see you on<br>{{$event->date}}!</h3>
                        <p class="success-message">Your reservation has been confirmed. <br>Check your email for details<i class="fa-regular fa-face-smile-wink"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif                    
