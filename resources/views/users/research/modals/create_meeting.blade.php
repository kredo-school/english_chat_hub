<!--Create Meeting-->
<div class="modal fade" id="create-meeting">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('users.meeting.store') }}" method="post">
                @csrf

                <div class="modal-header border-0">
                    <h3 class="modal-title fs-3 fw-bold d-inline mx-auto">Create Meeting</h3>
                </div>
                <div class="modal-body">
                    <div class="col-8 mx-auto">

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" id="category" class="form-select" required>
                                @foreach ($all_categories as $category_a)
                                    @if($category_a->id == $category->id)
                                        <option value="{{ $category_a->id }}" selected>{{ $category_a->name }}</option>
                                    @else    
                                        <option value="{{ $category_a->id }}">{{ $category_a->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="date" class="form-label">Date</label>
                                <select name="date" id="date" class="form-select" required>
                                    <option value="" disabled selected>Select Date</option>
                                    @foreach ($availableRooms as $date => $value)
                                        <option value="{{ $date }}">{{ $date }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-6">
                                <label for="start_at" class="form-label">Start At</label>
                                <select name="start_at" id="start_at" class="form-select" disabled required>
                                    <option value="" disabled selected>Select Time</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-5">
                            <div class="col-6">
                                <label for="level" class="form-label">Level</label>
                                <select name="level_id" id="level" class="form-select" required>
                                    @foreach ($all_levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="room" class="form-label">Room</label>
                                <select name="room_id" id="room" class="form-select" disabled required>
                                    <option value="" disabled selected>Select Room</option>
                                </select>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer border-0">
                    <div class="text-end">
                        <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="button btn-orange">Create</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

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

@section('script')
    <script>
        $(document).ready(function() {
            $('#create-meeting-error').modal('show');
        });
    </script>
@endsection