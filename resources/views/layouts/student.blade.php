<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management - Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background-color: #1a472a; }
        .sidebar a { color: #ecf0f1; text-decoration: none; }
        .sidebar a:hover { background-color: #2d6a4f; border-radius: 5px; }
        .sidebar .active { background-color: #40916c; border-radius: 5px; }
        .main-content { background-color: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <div class="text-center mb-4">
    <img src="{{ asset('images/kuet-logo.png') }}" alt="KUET Logo" style="width: 60px; height: 60px; object-fit: contain;">
    <h5 class="text-white mt-2">Student Panel</h5>
</div>
            <nav class="nav flex-column gap-1">
                <a href="{{ route('student.dashboard') }}" class="nav-link px-3 py-2 {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('student.meals.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('student.meals*') ? 'active' : '' }}">
                    <i class="bi bi-cup-hot"></i> Meal
                </a>
                <a href="{{ route('student.fees.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('student.fees*') ? 'active' : '' }}">
                    <i class="bi bi-cash"></i> Fees
                </a>
                <a href="{{ route('student.complaints.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('student.complaints*') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i> Complaints
                </a>
                <a href="{{ route('student.notices.index') }}" class="nav-link px-3 py-2 {{ request()->routeIs('student.notices*') ? 'active' : '' }}">
    <i class="bi bi-megaphone"></i> Notices
</a>
                <hr class="text-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </nav>
        </div>
        <div class="col-md-10 main-content p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>