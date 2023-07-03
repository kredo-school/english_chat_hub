@if ($meeting = $room->meetings()->where('date', $date)->first())
    <!--Join Modal-->
    <div class="modal fade" id="reservation-{{ $meeting->id }}">
        <div class="modal-dialog">
            <div class="modal-content border border-2 border-warning">

                <div class=“modal-body”>
                    <div class="modal-title text-center fs-2 my-3 fw-bold">Make a Reservation</div>
                    <p class="modal-text mx-auto mb-0 fs-4">{{ $meeting->category->name }}</p>
                    <p class="modal-text mx-auto mb-3 fs-4">〜{{ $meeting->title }}〜</p>
                    <p class="modal-text mx-auto mb-3">Date: {{ $meeting->date }}</p>
                    <p class="modal-text mx-auto mb-3">Time: {{ $meeting->start_at }}</p>
                    <p class="modal-text mx-auto mb-3">Level: {{ $meeting->level->name }}</p>
                </div>

                {{-- button --}}
                <div class="buttons mt-5 mb-3 text-center">
                    <button class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button class="button btn-orange">Reservation</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@else
    <!--Create Modal-->
    <div class="modal fade" id="create-meeting-{{ $i }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.meeting.store') }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h3 class="modal-title fs-3 fw-bolc d-inline mx-auto">Create Meeting</h3>
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
                                <input type="text" name="title" id="title" class="form-control" required>
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
@endif
