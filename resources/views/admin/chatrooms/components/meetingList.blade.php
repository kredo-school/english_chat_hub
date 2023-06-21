<!-- Table Body -->
<div class="w-100 mt-0 pt-0">
    <div class="container mt-0 pt-0">
        <table class="table table-sm table-striped align-middle text-center">
            <tbody>
                @forelse ($meetings as $meeting)
                    <tr>
                        <td style="width: 50px">{{ $loop->index + 1 }}</td>
                        <td class="text-start">{{ $meeting->title }}</td>
                        <td>{{ $meeting->user->user_name }}</td>
                        <td>{{ $meeting->date }} {{ date('G:i', strtotime($meeting->start_at)) }}~</td>
                        <td>{{ request()->is('*/rooms/*') ? $meeting->category()->withTrashed()->first()->name : $meeting->room()->withTrashed()->first()->name }}</td>
                        <td style="width: 100px">
                            @if ($meeting->deleted_at)
                                <i class="fa-solid fa-eye-slash text-danger"></i>
                            @else
                                <i class="fa-solid fa-circle text-{{ $statusColor[$meeting->status_id] }}"></i>
                            @endif
                        </td>
                        <td style="width: 100px">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#member-{{ $meeting->id }}"
                                class="btn btn-sm">
                                <i class="fa-solid fa-users"></i> {{ $meeting->joinMeetings->count() }}
                            </button>
                        </td>
                    </tr>
                    {{-- include modal --}}
                    @include('admin.chatrooms.meetings.modals.member')
                @empty
                    <tr>
                        <td colspan="100">No Meetings Yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>{{ $meetings->links() }}</div>
    </div>
</div>

<hr>

<div class="footer pt-3" style="max-height: 90px">
    {{ $meetings->links() }}
</div>
