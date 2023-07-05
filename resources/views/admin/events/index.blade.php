@extends('layouts.admin-app')

@section('title','All Events')
@section('hilight_text','Events')
@section('subtitle','All Events')

@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status">
            <div class="create-event">
                <a type="button" href="{{route('admin.events.create')}}"><i class="fa-solid fa-circle-plus"></i><span class="ms-2">Create New Event</span></a>
            </div>

            <form action="#" class="search-bar-sm">
                <input type="search" class="form-control search-text" placeholder="seaech for events..." id="search-input">
            </form>
            <div class="status-group-sm">
                <ul>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                        <span class="fs-4">available</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-danger icon-status"></i>
                        <span class="fs-4 pe-3">occupied</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                        <span class="fs-4 pe-3">done</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                @if ($all_events -> isNotEmpty())
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Level</th>
                            <th>Theme</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>status</th>
                            <th>detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_events as $event)
                        <tr class="eventtable-tr">
                            <td>{{ $event->id }}</td>
                            <td>{!! $event->getEventString() !!}</td>
                            <td>{{ $event->theme }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->created_at }}</td>
                            <td>{{ $event->updated_at }}</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.events.edit', $event->id)}}">Edit event info</a>
                                    <a class="dropdown-item" href="{{ route('admin.events.showParticipants',$event->id)}}"> Participants List</a>
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-event-{{$event->id}}">
                                        Delete
                                     </button>
                                </div>
                                @include('admin.events.modal.delete-event')
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h1 class="my-5">There is no events yet...</h1>

                @endif

            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <span> showing {{ $all_events->firstItem() }} to {{ $all_events->lastItem() }} of {{ $all_events->total() }} events</span>
                <span class="float-end">{{ $all_events->links() }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('search-input').addEventListener('input', function () {
        var input, filter, table, tr, tdLevel, tdTheme, tdDate, i, txtValueLevel, txtValueTheme, txtValueDate;
        input = document.getElementById("search-input");
        filter = input.value.toUpperCase().replace(/\s/g, "");
        table = document.getElementsByTagName("table")[0];
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            tdLevel = tr[i].getElementsByTagName("td")[1]; // Level column
            tdTheme = tr[i].getElementsByTagName("td")[2]; // Theme column
            tdDate = tr[i].getElementsByTagName("td")[3]; // Date column

            if (tdLevel || tdTheme || tdDate) {
                txtValueLevel = tdLevel.textContent || tdLevel.innerText;
                txtValueTheme = tdTheme.textContent || tdTheme.innerText;
                txtValueDate = tdDate.textContent || tdDate.innerText;

                if (
                    txtValueLevel.toUpperCase().indexOf(filter) > -1 ||
                    txtValueTheme.toUpperCase().indexOf(filter) > -1 ||
                    txtValueDate.toUpperCase().indexOf(filter) > -1
                ) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
@endsection
