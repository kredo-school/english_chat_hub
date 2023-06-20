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
            <div class="modal-footer border-0">
                <form action="#" method="post" class="mt-0">
                    @csrf
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-orange">Join</button>  
                        {{-- Modal --}}
                        @if (session('success'))
                        <div class="modal fade success-modal" id="join-event-result" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="join-event-result-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-box">
                                            <div class="modal-text">
                                                <h3 class="h5 success-title mb-3">Looking forward to see you on {{$event->date}}!</h3>
                                                <p class="success-message">Your reservation has been confirmed. Check your email for details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif                    
                </form>
            </div>
        </div>
    </div>
</div>