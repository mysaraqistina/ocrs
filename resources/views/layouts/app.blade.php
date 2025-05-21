<!doctype html>
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
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', 'Nunito', Arial, sans-serif;
            background: linear-gradient(135deg, #181818 0%, #232526 60%, #bfa14a 120%);
            min-height: 100vh;
            color: #f5f5f5;
            position: relative;
            letter-spacing: 0.03em;
        }

        /* Subtle carbon fiber pattern overlay */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.13;
            z-index: 0;
            pointer-events: none;
        }

        /* Glassmorphism effect for cards and navbar */
        .card, .glass, .navbar {
            background: rgba(35, 37, 38, 0.82) !important;
            backdrop-filter: blur(6px);
            border-radius: 1.5rem !important;
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.18);
            border: 1px solid #bfa14a33;
            color: #f5f5f5;
            transition: box-shadow 0.3s;
        }
        .card:hover, .glass:hover {
            box-shadow: 0 12px 36px 0 rgba(191, 161, 74, 0.28);
        }

        /* Navbar brand and gold accent */
        .navbar-brand, .navbar-brand span, .display-4, .fw-bold, .card-title {
            color: #e7c873 !important;
            letter-spacing: 1.5px;
            font-weight: 700;
            text-shadow: 0 2px 12px #bfa14a33;
        }

        /* Navbar glass effect and gold underline on active/hover */
        .navbar {
            border-bottom: 2px solid #bfa14a44;
            box-shadow: 0 4px 24px 0 rgba(191, 161, 74, 0.08);
        }
        .navbar-nav .nav-link {
            color: #f5f5f5 !important;
            font-weight: 500;
            font-size: 1.08rem;
            padding: 0.5rem 1.2rem;
            border-radius: 2rem;
            position: relative;
            transition: color 0.2s, background 0.2s;
        }
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: #bfa14a !important;
            background: rgba(191, 161, 74, 0.08);
        }
        .navbar-nav .nav-link.active::after,
        .navbar-nav .nav-link:hover::after {
            content: "";
            display: block;
            margin: 0 auto;
            width: 60%;
            height: 3px;
            border-radius: 2px;
            background: linear-gradient(90deg, #bfa14a 0%, #fffbe6 100%);
            margin-top: 4px;
            box-shadow: 0 2px 8px #bfa14a55;
        }

        /* Premium button styling */
        .btn-warning, .btn-warning:focus, .btn-warning:active {
            background: linear-gradient(90deg, #bfa14a 0%, #fffbe6 100%) !important;
            border: none !important;
            color: #232526 !important;
            font-weight: bold;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 12px #bfa14a33;
            border-radius: 2rem;
            padding: 0.6rem 2rem;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-warning:hover {
            background: linear-gradient(90deg, #a88b32 0%, #bfa14a 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 18px #bfa14a55;
        }

        /* Carousel image styling */
        .carousel-inner img {
            height: 350px;
            object-fit: cover;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px #000a;
        }

        /* Carousel caption styling */
        .carousel-caption {
            background: rgba(35, 37, 38, 0.7) !important;
            border-radius: 1rem;
            color: #bfa14a !important;
            font-weight: 500;
            text-shadow: 0 2px 12px #18181877;
        }

        /* Footer styling */
        footer {
            color: #bfa14a;
            letter-spacing: 1px;
            font-size: 1.1rem;
            background: transparent;
            border-top: 1px solid #bfa14a33;
            margin-top: 2rem;
            padding: 1.5rem 0 0.5rem 0;
            text-align: center;
        }

        /* Custom scroll bar for luxury feel */
        ::-webkit-scrollbar {
            width: 10px;
            background: #232526;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #bfa14a 0%, #232526 100%);
            border-radius: 8px;
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

                            @if (Route::has('auth.register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.register') }}">{{ __('Register') }}</a>
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
