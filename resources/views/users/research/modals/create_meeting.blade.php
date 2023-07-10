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
                            <select name="category_id" id="category" class="form-select">
                                @foreach ($all_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>

                            <div class="col-6">
                                <label for="start_at" class="form-label">Start At</label>
                                <div class="input-group">
                                    <input type="text" name="start_num" id="start_at" class="form-control" required><span class="input-group-text"> : 00</span>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row mb-5">
                            <div class="col-6">
                                <label for="level" class="form-label">Level</label>
                                <select name="level_id" id="level" class="form-select">
                                    @foreach ($all_levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="room" class="form-label">Room</label>
                                <select name="room_id" id="level" class="form-select">
                                    @foreach ($all_rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
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