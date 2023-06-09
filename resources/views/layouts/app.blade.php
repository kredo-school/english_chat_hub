<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/button.css') }}">
    <link rel="stylesheet" href="{{ mix('css/form.css') }}">
    <link rel="stylesheet" href="{{ mix('css/modal.css') }}">

    @yield('style')
    
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
    
</head>
<body>
    <header>
        <nav class="navbar navbar-fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item me-2">
                        @if(auth()->check())
                            <a href="{{ route('users.top') }}">
                                <img class="logo mb-1" src="{{ asset('image/logo.png') }}" alt="logo">
                            </a>
                        @else
                            <a href="{{ url('/') }}">
                                <img class="logo mb-1" src="{{ asset('image/logo.png') }}" alt="logo">
                            </a>
                        @endif
                    </li>
                    <li class="nav-item pt-2">
                        @if (auth()->check())
                            <a class="navbar-brand fw-bold me-5" href="{{ route('users.top') }}" >
                                English Chat Hub
                            </a>
                        @else
                            <a class="navbar-brand fw-bold me-5" href="{{ url('/') }}" >
                                English Chat Hub
                            </a>
                        @endif
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse m-auto" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                            <li class="nav-item me-5">
                                <a href="{{ url('/') }}#about-us" class="link-item">About Us</a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="{{ url('/') }}#how-to-use" class="link-item">How to use</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item me-5">
                                <a href="{{ route('users.top') }}" class="link-item">Home</a>
                            </li>
                        @endauth
                            <li class="nav-item me-5">
                                <a href="{{ route('events.index') }}" class="link-item">Event</a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="{{ route('contact-us.create') }}" class="link-item">Contact Us</a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="{{ url('/faq') }}" class="link-item">FAQ</a>
                            </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><button class="button btn-orange me-md-2">{{ __('LOG IN') }}</button></a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><button class="button btn-orange">{{ __('REGISTER') }}</button></a>
                            </li>
                        @else
                            <a href="{{ route('logout') }}" class="logout me-5 fa-2x"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('banner')
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container-fluid row">
            <div class="col"></div>
            <div class="brand-group col-2 mt-3 me-5">
                @if(auth()->check())
                    <a class="footer-brand" href="{{ route('users.top') }}">
                        English Chat Hub
                    </a>
                @else
                    <a class="footer-brand" href="{{ url('/') }}">
                        English Chat Hub
                    </a>
                @endif
                <p class="copy-right">COPYRIGHT © English Chat Hub ALL RIGHTS RESERVED.</p>
            </div>
            <div class="footer-links col-6 mt-3 ms-5">
                <ul>
                    @guest
                    <li class="me-5">
                        <a href="{{ url('/') }}#about-us" class="footer-link">About Us</a>
                    </li>
                    <li class=" me-5">
                        <a href="{{ url('/') }}#how-to-use" class="footer-link">How to use</a>
                    </li>
                    @endguest
                    <li class="me-5">
                        <a href="{{ route('events.index') }}" class="footer-link">Event</a>
                    </li>
                    <li class="me-5">
                        <a href="{{ route('contact-us.create') }}" class="footer-link">Contact Us</a>
                    </li>
                    <li class="me-5" >
                        <a href="{{ url('faq') }}" class="footer-link">FAQ</a>
                    </li>
                </ul>
                <ul>
                    <li class="me-5">
                        <a href="{{ route('terms') }}" class="plus-footer-link">Terms of Service</a>
                    </li>
                    <li class="me-5">
                        <a href="{{ route('privacy') }}" class="plus-footer-link">Privacy Policy</a>
                    </li>
                </ul>
            </div>
            {{-- SNS icons --}}
            <div class="fa-2x sns-icons col-2 text-end">
                <a href="https://twitter.com/" class="sns-icon m-2"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.facebook.com/" class="sns-icon m-2"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" class="sns-icon m-2"><i class="fa-brands fa-instagram"></i></a>    
            </div>
            <div class="col"></div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
