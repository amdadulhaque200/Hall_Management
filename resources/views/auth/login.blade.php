<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Khan Jahan Ali Hall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a472a, #2c3e50);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-left {
            background: linear-gradient(135deg, #1a472a, #2c3e50);
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .login-right {
            background: white;
            padding: 3rem 2rem;
        }
        .btn-login {
            background: linear-gradient(135deg, #1a472a, #2c3e50);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-login:hover {
            opacity: 0.9;
            color: white;
        }
        .form-control:focus {
            border-color: #1a472a;
            box-shadow: 0 0 0 0.2rem rgba(26,71,42,0.2);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card login-card border-0">
                <div class="row g-0">

                    {{-- Left Side --}}
                    <div class="col-md-5 login-left">
                        <img src="{{ asset('images/kuet-logo.png') }}" alt="KUET Logo" style="width: 100px; height: 100px; object-fit: contain;">
    <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1z"/>
</svg>
                        <h4 class="fw-bold mt-3 text-center">Khan Jahan Ali Hall</h4>
                        <p class="text-white-50 text-center small mt-2">Khulna University of Engineering & Technology</p>
                        <hr class="w-100 text-white">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bi bi-people fs-4"></i>
                                <p class="small mb-0">Student Management</p>
                            </div>
                            <div class="mb-3">
                                <i class="bi bi-cash fs-4"></i>
                                <p class="small mb-0">Fee Management</p>
                            </div>
                            <div class="mb-3">
                                <i class="bi bi-megaphone fs-4"></i>
                                <p class="small mb-0">Notice Board</p>
                            </div>
                        </div>
                        <a href="{{ route('home') ?? '/' }}" class="btn btn-outline-light btn-sm mt-3">
                            <i class="bi bi-arrow-left"></i> Back to Home
                        </a>
                    </div>

                    {{-- Right Side --}}
                    <div class="col-md-7 login-right">
                        <h3 class="fw-bold mb-1">Welcome Back!</h3>
                        <p class="text-muted mb-4">Login to your hall account</p>

                        {{-- Session Status --}}
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-envelope"></i> Email Address
                                </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Enter your email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-lock"></i> Password
                                </label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-success small">Forgot password?</a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-login w-100 fs-5">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </form>

                        <p class="text-center text-muted small mt-4">
                            © {{ date('Y') }} Khan Jahan Ali Hall, KUET
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>