{{-- Cancel Event Modal for Auth::user() --}}
<div class="modal fade" id="cancel-event-{{$event->id}}">
    <div class="modal-dialog">
    
        <div class="modal-content border border-2 border-danger">
            <div class="modal-header border-danger">
                <h2 class="modal-title text-danger fs-3 fw-bold mx-auto">Confirmed detail</h2>
            </div>
            <div class="modal-body">
                <p class="h6 text-muted text-center">Are ou sure you want to cancel the event on
                <span class="text-danger">
                    @php($carbonDateTime = \Carbon\Carbon::parse($event->date))
                    {{ $carbonDateTime->toDateString() }}&nbsp;<span class="text-muted">at</span>&nbsp;{{ $carbonDateTime->format('H:i') }}
                </span>?</p>
            </div>
            <div class="modal-footer border-0" style="justify-content: center">
                <form action="{{route('events.destroyAuthParticipant', $event->id)}}" method="post" class="mt-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger  btn-lg"><strong>Cancel Event</strong></button>
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
                        {{-- <h3 class="success-title mb-3">Happy to see you on<br>{{$event->date}}!</h3> --}}
                        <h3 class="success-title mb-3">Happy to see you on<br>{{ $carbonDateTime->toDateString() }}!</h3>
                        <p class="success-message">Your reservation has been confirmed. <br>Check your email<br>for details<i class="fa-regular fa-face-smile-wink"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif                    
