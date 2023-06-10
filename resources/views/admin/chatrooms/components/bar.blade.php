<div class="row gx-1 mb-3">
    <div class="col">
        <a href="{{ route('admin.chatroom.meeting.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatroom/meeting*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Meeting</a>
    </div>
    <div class="col">
        <a href="{{ route('admin.chatroom.room.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatroom/room*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Room</a>
    </div>
    <div class="col">
        <a href="{{ route('admin.chatroom.category.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatroom/category*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Category</a>
    </div>
</div>
