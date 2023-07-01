@extends('layouts.admin-app')

@section('title','All Users')
@section('hilight_text','Users')
@section('subtitle','All Users')
@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status">
            <form action="#" class="search-bar-sm">
                <input type="search" class="form-control search-icon" placeholder="search &#xf002;">
            </form>
            <div class="status-group-sm">
                <ul>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                        <span class="fs-4">deleted</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-danger icon-status"></i>
                        <span class="fs-4 pe-3">deactivate</span>
                    </li>
                    <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                        <span class="fs-4 pe-3">activate</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                @if ($all_users->isNotEmpty())
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>E-mail</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>status</th>
                            <th>detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_users as $user)
                            @if ($user->role != 'admin')
                                <tr class="usertable-tr">
                                    <td>{{$user->id}}</td>
                                    <td>
                                        @if($user->avatar)
                                            <img src="#" alt="{{$user->avatar}}">
                                        @else
                                            <i class="fa-solid fa-circle-user avatar-lg"></i>
                                        @endif
                                    </td>
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                    <div class="dropdown">
                                        @if ($user->trashed())
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                            </button>
                                        @else
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                                <i class="fa-solid fa-circle text-success"></i>
                                            </button>
                                        @endif
                                    </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn" data-bs-toggle="dropdown">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show-profile-{{$user->id}}">
                                                show profile
                                            </button>
                                        </div>
                                        @include('admin.users.modal.showprofile')
                                        @include('admin.users.modal.status')
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="m-4 text-center">
                    <h1 class="my-5">There is No User yet.</h1>
                </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="col footer pt-3 ps-3">
            {{--[Soon] it will show the pagination below --}}
            showing 1 to 10 of 50 users
        </div>
    </div>
</div>
@endsection

