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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card p-4">
            <h3 class="text-center mb-4" style="color: #0d1e5b;">Admin Login</h3>
            <form method="POST" action="{{ route('admin.login') }}">
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
            </form>
            <div class="text-center mt-4">
                <a href="{{ url('/login') }}" class="fw-bold text-decoration-none" style="color: #0d1e5b;">Back to Customer Login</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
