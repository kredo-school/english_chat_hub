@extends('layouts.admin-app')

@section('title','All Users')
@section('content')
<div class="row">
    <div class="col content">
        <div class="row search-status">
            <form action="#" class="search-bar">
                <input type="search" class="form-control search-icon" placeholder="search &#xf002;">
            </form>
            <div class="status-group">
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
                <table class="user-table">
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
                        <tr>
                            <td>1</td>
                            <td><i class="fa-solid fa-circle-user avatar-lg"></i></td>
                            <td>Kei</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr class="color-2">
                            <td>2</td>
                            <td><i class="fa-solid fa-circle-user avatar-lg"></i></td>
                            <td>Kei</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr >
                            <td>3</td>
                            <td><i class="fa-solid fa-circle-user avatar-lg"></i></td>
                            <td>Kei</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr class="color-2">
                            <td>4</td>
                            <td><i class="fa-solid fa-circle-user avatar-lg"></i></td>
                            <td>Kei</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><i class="fa-solid fa-circle-user avatar-lg"></i></td>
                            <td>Kei</td>
                            <td>Kei Sasaki</td>
                            <td>kei@gmail.com</td>
                            <td>20xx-xx-xx</td>
                            <td>20xx-xx-xx</td>
                            <td><i class="fa-solid fa-circle text-success"></i></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
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
