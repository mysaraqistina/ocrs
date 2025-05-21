<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Easy Car Enterprise') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('{{ asset('images/faded-car.jpeg') }}') no-repeat center center;
            background-size: cover;
            opacity: 0.80;
            z-index: 0;
            pointer-events: none;
        }
        .login-container, .card {
            position: relative;
            z-index: 1;
        }
        .card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem #fcb69f50;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-3">
                <img src="{{ asset('images/car.png') }}" alt="Logo" width="60" class="mb-2 rounded-circle shadow-sm">
                <h3 class="fw-bold" style="color: #0d1e5b;">Admin Login</h3>
            </div>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email address</label>
                    <input type="email" class="form-control rounded-pill px-3" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="bi bi-lock"></i> Password</label>
                    <input type="password" class="form-control rounded-pill px-3" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn w-100 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 1.1rem; background-color: #0d1e5b; color: #fff;">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </button>
            </form>
            <div class="text-center mt-4">
                <a href="{{ url('/login') }}" class="fw-bold text-decoration-none" style="color: #0d1e5b;">
                    <i class="bi bi-arrow-left-circle me-1"></i>Back to Customer Login
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
