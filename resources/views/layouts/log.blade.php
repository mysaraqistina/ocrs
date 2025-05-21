<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #fff;
            min-height: 100vh;
        }
        .login-container {
            max-width: 400px;
            margin: 60px auto;
        }
        .card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem #fcb69f50;
        }
        .brand-logo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/car.png') }}" alt="Logo" width="32" height="32" class="me-2 rounded-circle">
                {{ config('app.name', 'Easy Car Enterprise') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="login-container">
        <div class="card p-4">
            <div class="text-center">
                <img src="{{ asset('images/car.png') }}" alt="Logo" class="brand-logo shadow">
                <h2 class="fw-bold mb-2">Easy Car Enterprise</h2>
                <p class="text-muted mb-4">Sign in to your account</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="bi bi-lock"></i> Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: #0d1e5b; border-color: #0d1e5b;">Login</button>
                <div class="text-center mt-3">
                    {{-- <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #0d1e5b;">Forgot Password?</a> --}}
                </div>
            </form>
            <div class="text-center mt-4">
                <span>Don't have an account?</span>
                <a href="{{ route('auth.register') }}" class="fw-bold text-decoration-none" style="color: #0d1e5b;">Register</a>
            </div>
            <div class="text-center mt-2">
                <span>Are you an admin?</span>
                <a href="{{ url('/admin/login') }}" class="fw-bold text-decoration-none" style="color: #0d1e5b;">Admin Login</a>
            </div>
        </div>
    </div>
   
</body>
</html>