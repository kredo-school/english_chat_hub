@extends('layouts.admin-app')

@section('title','Inbox')
@section('hilight_text','Inbox')
@section('subtitle','All Messages')

@section('content')
<div class="row">
  <div class="col content">
    <div class="row search-status">
        <form action="#" class="search-bar-sm">
            <input type="search" class="form-control search-text" placeholder="seaech for name or subtitle..." id="search-input">
        </form>
        <div class="status-group-sm">
            <ul>
                <li>
                    <i class="fs-4 pt-2 fa-solid fa-circle text-secondary icon-status"></i>
                    <span class="fs-4">done</span>
                </li>
                <li>
                    <i class="fs-4 pt-2 fa-solid fa-circle text-danger icon-status"></i>
                    <span class="fs-4 pe-3">in progress</span>
                </li>
                <li>
                    <i class="fs-4 pt-2 fa-solid fa-circle text-success icon-status"></i>
                    <span class="fs-4 pe-3">not started</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
      <div class="col-12 mt-3">
          @if ($all_messages -> isNotEmpty())
          <table class="table table-striped text-center align-middle">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Subtitle</th>
                      <th>Title</th>
                      <th>created_at</th>
                      <th>updated_at</th>
                      <th>status</th>
                      <th>detail</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($all_messages as $message)
                  <tr class="usertable-tr">
                      <td>{{ $message->id }}</td>
                      <td>{{ $message->name}}</td>
                      <td>{{ $message->subtitle->name}}</td>
                      <td>{{ $message->title }}</td>
                      <td>{{ $message->created_at }}</td>
                      <td>{{ $message->updated_at }}</td>
                      <td>
                        <div class="dropdown">
                            <form class="d-inline" method="POST" action="{{ route('admin.inbox.update_status', $message->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="btn dropdown" type="submit" data-bs-toggle="dropdown">
                                    @if ($message->status_id === 1)
                                        <i class="fa-solid fa-circle text-success"></i>
                                    @elseif ($message->status_id === 2)
                                        <i class="fa-solid fa-circle text-danger"></i>
                                    @elseif ($message->status_id === 0)
                                        <i class="fa-solid fa-circle text-secondary"></i>
                                    @endif
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item" type="submit" name="status" value="1">
                                            <i class="fa-solid fa-circle text-success me-1"></i> not started
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" type="submit" name="status" value="2">
                                            <i class="fa-solid fa-circle text-danger me-1"></i> in progress
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" type="submit" name="status" value="0">
                                            <i class="fa-solid fa-circle text-secondary me-1"></i> done
                                        </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        
                      </td>
                      <td>
                          <div class="dropdown">
                              <button class="btn" data-bs-toggle="dropdown">
                                  <i class="fa-solid fa-ellipsis"></i>
                              </button>
                          <div class="dropdown-menu">
                              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#message-detail-{{ $message->id }}">
                                  Show Message
                               </button>
                          </div>
                          @include('admin.inbox.modal.message-detail')
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          @else
              <h1 class="my-5">There is no message yet...</h1>
          @endif
      </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-12">
        <span> showing {{ $all_messages->firstItem() }} to {{ $all_messages->lastItem() }} of {{ $all_messages->total() }} messages</span>
        <span class="float-end">{{ $all_messages->links() }}</span>
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
        tdUserName = tr[i].getElementsByTagName("td")[1]; // UserName column
        tdSubTitles = tr[i].getElementsByTagName("td")[2]; // Subtitles column

        if (tdUserName || tdSubTitles ) {
            txtValueUserName = tdUserName.textContent || tdUserName.innerText;
            txtValueSubTitles = tdSubTitles.textContent || tdSubTitles.innerText;

            if (
                txtValueUserName.toUpperCase().indexOf(filter) > -1 ||
                txtValueSubTitles.toUpperCase().indexOf(filter) > -1 
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