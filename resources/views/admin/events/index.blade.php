@extends('layouts.admin-app')

@section('title','All Events')

@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status">
            <div class="create-event">
                <a type="button" href="{{route('admin.createEvent')}}"><i class="fa-solid fa-circle-plus"></i><span class="ms-2">Create New Event</span></a>
            </div>

            <form action="#" class="search-bar-sm">
                <input type="search" class="form-control search-icon" placeholder="search &#xf002;">
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
                <table class="user-table text-center">
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
                            <td>{{ $event->getEventString() }}</td>
                            <td>{{ $event->theme }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->created_at }}</td>
                            <td>{{ $event->updated_at }}</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><a href="#"><i class="fa-solid fa-ellipsis"></i></a></td>
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
        <div class="col footer pt-3 ps-3">
            showing 1 to 10 of 50 users
        </div>
    </div>
</div>

@endsection
