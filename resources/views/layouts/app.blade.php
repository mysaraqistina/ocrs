<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            /* Deep luxury gradient with gold accent */
            background: linear-gradient(135deg, #181818 0%, #232526 60%, #bfa14a 120%);
            min-height: 100vh;
            position: relative;
            color: #f5f5f5;
        }

        /* Subtle diamond pattern overlay for depth */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png');
            opacity: 0.12;
            z-index: 0;
            pointer-events: none;
        }

        /* Premium card styling */
        .card, .bg-gradient {
            border-radius: 1.5rem !important;
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.18);
            background: rgba(35, 37, 38, 0.97) !important;
            border: 1px solid #bfa14a33;
            color: #f5f5f5;
        }

        /* Gold accent for headings and brand */
        .navbar-brand, .display-4, .fw-bold, .card-title {
            color: #bfa14a !important;
            letter-spacing: 1px;
        }

        /* Gold accent for nav links on hover */
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link.active {
            color: #bfa14a !important;
            text-shadow: 0 1px 8px #bfa14a33;
        }

        /* Gold buttons for CTAs */
        .btn-warning, .btn-warning:focus, .btn-warning:active {
            background-color: #bfa14a !important;
            border-color: #bfa14a !important;
            color: #232526 !important;
            font-weight: bold;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 12px #bfa14a33;
        }
        .btn-warning:hover {
            background-color: #a88b32 !important;
            border-color: #a88b32 !important;
            color: #fff !important;
        }

        /* Carousel image styling */
        .carousel-inner img {
            height: 350px;
            object-fit: cover;
            border-radius: 1.5rem;
        }

        /* Carousel caption styling */
        .carousel-caption {
            background: rgba(35, 37, 38, 0.7) !important;
            border-radius: 1rem;
            color: #bfa14a !important;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/car.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
                    {{ config('app.name', 'Easy Car Enterprise') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
