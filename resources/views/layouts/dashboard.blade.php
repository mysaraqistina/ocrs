<!-- layout for the application -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Easy Car Enterprise') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            /* Deep black-to-dark gradient with gold accent for luxury/sports car feel */
            background: linear-gradient(135deg, #181818 0%, #232526 60%, #bfa14a 120%);
            min-height: 100vh;
            color: #f5f5f5;
            position: relative;
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
            opacity: 0.18;
            z-index: 0;
            pointer-events: none;
        }
        .dashboard-navbar {
            background: linear-gradient(90deg, #181818 0%, #232526 100%);
            border-bottom: 2px solid #bfa14a;
            box-shadow: 0 4px 24px 0 rgba(191, 161, 74, 0.08);
        }
        .dashboard-navbar .navbar-brand,
        .dashboard-navbar .navbar-brand span {
            color: #bfa14a !important;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 2px 12px #bfa14a33;
        }
        .dashboard-navbar .nav-link {
            color: #f5f5f5 !important;
            font-weight: 500;
            transition: color 0.2s, background 0.2s;
            border-radius: 2rem;
            padding: 0.5rem 1.2rem;
        }
        .dashboard-navbar .nav-link.active,
        .dashboard-navbar .nav-link:hover {
            background: linear-gradient(90deg, #bfa14a 0%, #ffecb3 100%);
            color: #181818 !important;
            font-weight: bold;
            box-shadow: 0 2px 12px #bfa14a33;
        }
        .dashboard-card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.18);
            background: rgba(35, 37, 38, 0.97) !important;
            border: 1px solid #bfa14a33;
            color: #f5f5f5;
            animation: fadeIn 0.8s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .sidebar {
            background: rgba(33,37,41,0.95);
            border-radius: 1rem;
            min-height: 300px;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            transition: background 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #bfa14a 0%, #ffecb3 100%);
            color: #232526;
        }
        .dashboard-navbar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
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
        footer {
            color: #bfa14a;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md dashboard-navbar navbar-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/welcome') }}">
                <img src="{{ asset('images/car.png') }}" alt="Logo" width="36" height="36" class="me-2 rounded-circle shadow-sm">
                {{ config('app.name', 'Easy Car Enterprise') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavbar" aria-controls="dashboardNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="dashboardNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if(session('admin_id'))
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ url('/admin/index') }}"><i class="bi bi-house-door-fill"></i>Home</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="bi bi-list-ul"></i> All Bookings</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('admin.cars.index') }}"><i class="bi bi-car-front"></i> Cars</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm ms-2 fw-bold"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    @elseif(session('customer_id'))
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ url('/home') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('bookings.index') }}"><i class="bi bi-calendar-check"></i> My Bookings</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm ms-2 fw-bold"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            <div class="row g-4">
                
                <div class="col-12">
                    <div class="dashboard-card bg-white p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="text-center py-4 mt-5 text-muted small">
        <i class="bi bi-c-circle"></i> <span style="color: #fff;">{{ date('Y') }} Easy Car Enterprise. All rights reserved.</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>