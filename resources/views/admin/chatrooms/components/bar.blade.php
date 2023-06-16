<div class="row gx-1 mb-3">
    <div class="col">
        <a href="{{ route('admin.chatrooms.meetings.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatrooms/meetings*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Meeting</a>
    </div>
    <div class="col">
        <a href="{{ route('admin.chatrooms.rooms.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatrooms/rooms*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Room</a>
    </div>
    <div class="col">
        <a href="{{ route('admin.chatrooms.categories.index') }}"
            class="fs-4 d-block py-2 text-center text-decoration-none text-white"
            style="{{ request()->is('admin/chatrooms/categories*') ? 'background-color: var(--bs-primary)' : 'background-color: var(--gray)' }}">Category</a>
    </div>
</div>
