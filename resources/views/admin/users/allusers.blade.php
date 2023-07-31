@extends('layouts.admin-app')

@section('title','All Users')
@section('hilight_text','Users')
@section('subtitle','All Users')
@section('content')
<div class="row">
    <div class="col-12 content">
        <div class="row search-status">
            <form action="#" class="search-bar-sm">
                <input type="search" class="form-control search-text" placeholder="search username..." id="search-input">
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
                            <tr class="usertable-tr">
                                <td>{{$user->id}}</td>
                                <td>
                                    @if($user->avatar)
                                        <img src="/image/avatars/{{ $user->avatar }}" alt="{{$user->avatar}}" class="avatar-sm rounded-circle ">
                                    @else
                                        <i class="fa-solid fa-circle-user avatar-icon"></i>
                                    @endif
                                </td>
                                <td>{{$user->user_name}}</td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>
                                <div class="dropdown">
                                    @if ($user->trashed() && $user->self_delete == 0)
                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-circle text-danger"></i>
                                        </button>
                                    @elseif($user->trashed() && $user->self_delete == 1)
                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-circle text-secondary"></i>
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
        <div class="row">
            <div class="col-12">
                <span> showing {{ $all_users->firstItem() }} to {{ $all_users->lastItem() }} of {{ $all_users->total() }} users</span>
                <span class="float-end">{{ $all_users->links() }}</span>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('search-input').addEventListener('input', function () {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search-input");
        filter = input.value.toUpperCase().replace(/\s/g, "");
        table = document.getElementsByTagName("table")[0];
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
        tdUserName = tr[i].getElementsByTagName("td")[2]; // UserName column
        tdFullName = tr[i].getElementsByTagName("td")[3]; // FullName column
        tdEmail = tr[i].getElementsByTagName("td")[4]; // Email column

        if (tdUserName || tdFullName || tdEmail) {
            txtValueUserName = tdUserName.textContent || tdUserName.innerText;
            txtValueFullName = tdFullName.textContent || tdFullName.innerText;
            txtValueEmail = tdEmail.textContent || tdEmail.innerText;

            txtValueFullName = txtValueFullName.replace(/\s/g, "");

            if (
                txtValueUserName.toUpperCase().indexOf(filter) > -1 ||
                txtValueFullName.toUpperCase().indexOf(filter) > -1 ||
                txtValueEmail.toUpperCase().indexOf(filter) > -1
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

