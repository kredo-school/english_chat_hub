@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ mix('css/users-style.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="category">
            <h2 class="display-5">CATEGORY</h2>
            <p class="h5" id="category-title">Click the icon you're interested in!</p>
            <div class="row mt-3 justify-content-center">
              @forelse($all_categories as $category)
                <div class="card col-lg-3 col-md-6 mb-4 p-0">
                    <a href="" class="">
                      <div class="card-top" style="height: 156.31px; background-color: {{$category->color}};">
                        <img src="{{ asset('image/category' .$category->icon) }}" alt="" class="card-img-top" style="height: 80px; width:80px;"></a>
                      </div>

                      <div class="card-body">
                        <h5 class="card-title text-center" id="category-title">{{$category->name}}</h5>
                          <p class="card-text">{{ $category->description }}</p>
                      </div>                    
                </div>
              @empty
              @endforelse
            </div>

        </div>
      </div>
      <div class="col-4">
          @include('users.profile.show')
          @include('users.reserved.show')
      </div>
    </div>

    <div class="timetable mx-auto">
      <h2 class="display-5">TIME TABLE</h2>
        <div class="timetable-date fs-5">
          <i class="fa-solid fa-chevron-left"></i> 2023/06/10 <i class="fa-solid fa-chevron-right"></i>
        </div>
          <table class="mx-auto mt-2">
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
            <tr>
              <th>10:00~10:45</th>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
              <td>a</td>
            </tr>
          </table>
              <div class="tip mx-auto mt-3">
                <h3 class="tip-title">Join Chat Room</h3>
                <p class="tip-body">Click on the full you want to join and you'll get a join page!</p>
              </div>
              <div class="tip mx-auto mt-1">
                <h3 class="tip-title">Join Chat Room</h3>
                <p class="tip-body">Click on the full you want to join and you'll get a join page!</p>
              </div>
      </div>
</div> 
@endsection
