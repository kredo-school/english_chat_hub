@extends('layouts.admin-app')

@section('title','Inbox')
@section('hilight_text','Inbox')
@section('subtitle','All Messages')

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
          <table class="user-table text-center">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Title</th>
                      <th>created_at</th>
                      <th>updated_at</th>
                      <th>status</th>
                      <th>detail</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($all_messages as $message)
                  <tr class="eventtable-tr border border-dark">
                      <td>{{ $message->id }}</td>
                      <td>{{ $message->name}}</td>
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
                                        <i class="fa-solid fa-circle text-dark"></i>
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
  <div class="col footer pt-3 ps-3">
      showing 1 to 10 of 50 users
  </div>
</div>
</div>
@endsection