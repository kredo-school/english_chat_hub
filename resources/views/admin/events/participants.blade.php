@extends('layouts.admin-app')

@section('title','Event | Participants List')

@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status participants">
            <div class="col-6 participants-left">
                <h1 class="fs-2">Theme: {{ $event->theme }}</h1>
                <ul class="fs-5">Level: {{ $event->getEventStrComma() }}</li>
                    <li>Date: {{ $event->date }}</li>
                    <li>Location: {{ $event->location }}</li>
                </ul>
            </div>
            <div class="col-6 participants-right">
                <form action="#" class="search-bar-lg">
                    <input type="search" class="form-control search-icon" placeholder="search &#xf002;">
                </form>
                <div class="status-group-lg">
                    <ul>
                        <li>
                            <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                            <span class="fs-4">user</span>
                        </li>
                        <li>
                            <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                            <span class="fs-4 pe-3">guest</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
            @if ($participants)
                @if ($participants->isEmpty())
                    <p>No participants.</p>
                @else
                <table class="user-table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>status</th>
                            <th>detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <th>{{ $participant->id }}</th>
                            <th>{{ $participant->name }}</th>
                            <th>{{ $participant->email }}</th>
                            <th>{{ $participant->created_at }}</th>
                            <th>{{ $participant->updated_at }}</th>
                            <th></th>
                            <th></th>
                        @endforeach
                    </tbody>
                </table>
                @endif
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
