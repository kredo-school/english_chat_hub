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
                    {{-- <tbody>
                        @for($i=0;$i < 3; $i++)
                        <tr class="eventtable-tr">
                            <td>#</td>
                            <td>Beginner</td>
                            <td>Your Summer...</td>
                            <td>2023-XX-XX<br>12:00PM</td>
                            <td>Tokyo University<br>Room #333</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><a href="{{route('admin.participants')}}"><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                        <tr class="eventtable-tr color-2">
                            <td>#</td>
                            <td>Beginner</td>
                            <td>Your Summer...</td>
                            <td>2023-XX-XX<br>12:00PM</td>
                            <td>Tokyo University<br>Room #333</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        @endfor
                    </tbody> --}}
                </table>
            </div>

        </div>
        <hr>
        <div class="col footer pt-3 ps-3">
            showing 1 to 10 of 50 users
        </div>
    </div>
</div>

@endsection
