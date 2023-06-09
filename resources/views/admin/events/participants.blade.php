@extends('layouts.admin-app')

@section('title','Event | Participants List')

@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status participants">
            <div class="col-6 participants-left">
                <h1 class="fs-2">Things You Are Challenging</h1>
                <ul class="fs-5">
                    <li>Level: Beginner, Intermediate</li>
                    <li>Date: 2023-07-30 12:00PM</li>
                    <li>Location: Tokyo University Room#333</li>
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
                        @for($i=0; $i < 10; $i++)
                        <tr class="inbox-tr">
                            <td>#</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        @endfor
                    </tbody>
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
