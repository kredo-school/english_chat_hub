<!doctype html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="{{asset('css/button.css')}}">
  <link rel="stylesheet" href="{{asset('css/form.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin-style.css')}}">
  @yield('style')

</head>

<body>
    <header>
        <img src="{{asset('img/logo.png')}}" alt="" class="logo">
        <nav id="nav-side">
          <ul class="admin-sidebar adminmenu-icon mt-5">
            <li class="mb-5"><a href="{{ route('admin.showUsers') }}"><i class="fa-solid fa-users"></i></a></li>
            <li class="mb-5"><a href="{{ route('admin.chatrooms.meetings.index') }}"><i class="fa-sharp fa-solid fa-comment"></i></a></li>
            <li class="mb-5"><a href="{{ route('admin.inbox.show')}}"><i class="fa-solid fa-inbox"></i></a></li>
            <li class="mb-5"><a href="{{ route('admin.showEvents') }}"><i class="fa-solid fa-calendar-check"></i></a></li>
          </ul>
        </nav>
    </header>
    <section class="top-bar">
        <h2 class="title mt-4 ms-5 mb-5">
          {{-- Users should be replaced for each pages--}}
          <span class="highlight"> Users </span> | <span>Users</span>
          {{-- <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
          </a> --}}




          <a href="{{ route('logout') }}" class="logout float-end"  onclick="LogOutOnClick()">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </h2>
      </section>
    <main class="container">
        @yield('content')
    </main>
  <footer>
    @yield('footer')
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>
    function LogOutOnClick(){
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
  </script>
</body>

</html>
