{{-- Error Modal --}}
@if (session('error'))
<div class="modal fade" id="create-meeting-error" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-box">
                    <div class="modal-text">
                        <h3 class="h5 mb-3 text-danger fw-bold">Error</h3>
                        <p class="h6 fw-bold">The title is too long. <br>Please limit it to 50 characters.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif