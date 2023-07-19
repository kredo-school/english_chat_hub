<!-- Calendar modal -->
<div class="modal fade" id="calendar-modal">
    <div class="modal-dialog">
        <div class="modal-content position-relative">
            <div class="modal-body">
                <div class="wrapper">

                    <!-- mounth -->
                    <div id="next-prev-button">
                        <button id="prev" onclick="prev()">‹</button>
                        <h1 id="header"></h1>
                        <button id="next" onclick="next()">›</button>
                    </div>
                    <!-- Calendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Error Modal --}}
@if (session('error'))
<div class="modal fade" id="create-meeting-error" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-2 border-danger">
            <div class="modal-body">
                <button type="button" class="btn-close d-flex justify-content-start" data-bs-dismiss="modal" aria-label="Close"></button>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#create-meeting-error').modal('show');
        });
    </script>
@endsection
