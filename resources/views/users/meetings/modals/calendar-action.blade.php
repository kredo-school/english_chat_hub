@if ($meeting = $room->meetings()->where('date', $date)->where('start_at', $timeTable[$i][0])->first())
    <!--Join Modal-->
    @include('users.research.modals.reservation')
@else
    <!--Create Modal-->
    <div class="modal fade" id="create-meeting-{{ $i . '-' . $room->id }}">
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
                                <span class="form-label">date</span>
                                <div class="ps-3">{{ $date . ' ' . $timeTable[$i][0] . '~' . $timeTable[$i][1] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control js-count-text" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-select">
                                    @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level_id" id="level" class="form-select">
                                    @foreach ($all_levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" name="date" class="d-none" value="{{ $date }}" readonly>
                            <input type="text" name="start_at" class="d-none" value="{{ $timeTable[$i][0] }}"
                                readonly>
                            <input type="text" name="room_id" class="d-none" value="{{ $room->id }}" readonly>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-count-text').on('input', function () {
                const text = $(this).val();
                const errorElement = $('#error-message');

                if (text.length > 50) {
                    // Show error message and disable form submission
                    errorElement.text('Please enter a maximum of 50 characters.');
                    this.setCustomValidity('Please enter a maximum of 50 characters.');
                } else {
                    // Clear error message and enable form submission
                    errorElement.text('');
                    this.setCustomValidity('');
                }
            });
        });
    </script>
@endif


