@extends('layouts.admin-app')

@section('title','Event | Participants List')
@section('hilight_text','Events')
@section('subtitle','Participant List')


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
                    <input type="search" class="form-control search-text" placeholder="seaech for events..." id="search-input">
                </form>
                <div class="status-group-lg">
                    <ul>
                         <li>
                        <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                        <span class="fs-4 pe-3">guest</span>
                        </li>
                        <li>
                            <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                            <span class="fs-4 me-4">user</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                @if ($participants->isNotEmpty())
                <table class="table table-striped text-center align-middle">
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
                        <tr class="usertable-tr">
                            <td>{{ $participant->id }}</td>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->created_at }}</td>
                            <td>{{ $participant->updated_at }}</td>
                            <td>
                                @if ($participant->isUser == 1)
                                <i class="fa-solid fa-circle text-success"></i>
                                @elseif ($participant->isUser == 0)
                                <i class="fa-solid fa-circle text-secondary"></i>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                <div class="dropdown-menu">
                                    @if ($participant->isUser == 1)
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show-user-{{$participant->user->id}}">
                                            Show User Profile
                                        </button>
                                    @elseif ($participant->isUser == 0)
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show-guest-{{$participant->id}}">
                                            Show Guest User
                                        </button>
                                    @endif
                                </div>
                                @if ($participant->isUser == 1)
                                    @include('admin.events.modal.show-user-profile', ['user' => $participant->user])
                                @elseif($participant->isUser == 0)
                                    @include('admin.events.modal.show-guest-user', ['participant' => $participant])
                                @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="m-4 text-center">
                    <h1 class="my-5">There is No Participants yet.</h1>
                </div>
               
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <span> showing {{ $participants->firstItem() }} to {{ $participants->lastItem() }} of {{ $participants->total() }} participants</span>
                <span class="float-end">{{ $participants->links() }}</span>
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
        tdFullName = tr[i].getElementsByTagName("td")[1]; // FullName column
        tdEmail = tr[i].getElementsByTagName("td")[2]; // Email column

        if (tdFullName || tdEmail) {
            txtValueFullName = tdFullName.textContent || tdFullName.innerText;
            txtValueEmail = tdEmail.textContent || tdEmail.innerText;

            txtValueFullName = txtValueFullName.replace(/\s/g, "");

            if (
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
