<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUET Hall Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero { background: linear-gradient(135deg, #1a472a, #2c3e50); min-height: 100vh; }
        .nav-custom { background: rgba(0,0,0,0.3); }
        .feature-card:hover { transform: translateY(-5px); transition: 0.3s; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-dark nav-custom px-4 py-3">
    <span class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2">
    <img src="{{ asset('images/kuet-logo.png') }}" alt="KUET Logo" style="width: 40px; height: 40px; object-fit: contain;">
    Khan Jahan Ali Hall
</span>
    <a href="{{ route('login') }}" class="btn btn-outline-light">
        <i class="bi bi-box-arrow-in-right"></i> Login
    </a>
</nav>

{{-- Hero Section --}}
<div class="hero d-flex align-items-center">
    <div class="container text-white text-center py-5">
        <h1 class="display-4 fw-bold mb-3">Welcome to Hall Management System</h1>
        <p class="lead mb-4">Khan Jahan Ali Hall — Khulna University of Engineering & Technology</p>
        <p class="mb-5">A complete digital solution for managing residential hall operations, students, fees, notices and more.</p>
        <a href="{{ route('login') }}" class="btn btn-success btn-lg px-5">
            <i class="bi bi-box-arrow-in-right"></i> Login to Your Account
        </a>
    </div>
</div>

{{-- Features Section --}}
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">What We Offer</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-people fs-1 text-primary mb-3"></i>
                <h5>Student Management</h5>
                <p class="text-muted">Complete student records with border numbers, room assignments and academic info.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-cash fs-1 text-success mb-3"></i>
                <h5>Fee Management</h5>
                <p class="text-muted">Track monthly fees, payment status and dues for every student easily.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-megaphone fs-1 text-warning mb-3"></i>
                <h5>Notice Board</h5>
                <p class="text-muted">Hall admin can post notices and notify all students instantly.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-cup-hot fs-1 text-danger mb-3"></i>
                <h5>Meal Management</h5>
                <p class="text-muted">Students can turn their meal on or off for the next day from their account.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-chat-dots fs-1 text-info mb-3"></i>
                <h5>Complaint System</h5>
                <p class="text-muted">Students can submit complaints and get replies directly from hall admin.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow h-100 text-center p-4">
                <i class="bi bi-door-open fs-1 text-secondary mb-3"></i>
                <h5>Room & Seat Tracking</h5>
                <p class="text-muted">Monitor room occupancy and seat availability across the entire hall.</p>
            </div>
        </div>
    </div>
</div>

{{-- About Section --}}
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">About Khan Jahan Ali Hall</h2>
                <p class="text-muted">Khan Jahan Ali Hall is one of the prestigious residential halls of Khulna University of Engineering & Technology (KUET). Named after the great saint and ruler Khan Jahan Ali, the hall stands as a symbol of discipline, brotherhood and academic excellence.</p>
                <p class="text-muted">The hall provides comfortable accommodation for students with modern facilities including a dining hall, reading room, common room and a well-maintained living environment.</p>
                <p class="text-muted">This digital management system was built to streamline hall operations and improve communication between students and the hall administration.</p>
                <div class="mt-4">
                    <span class="badge bg-success me-2 p-2"><i class="bi bi-people"></i> Residential Students</span>
                    <span class="badge bg-primary me-2 p-2"><i class="bi bi-building"></i> KUET Campus</span>
                    <span class="badge bg-warning p-2"><i class="bi bi-star"></i> Est. KUET</span>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="p-4 rounded" style="background: linear-gradient(135deg, #1a472a, #2c3e50);">
                    <i class="bi bi-building text-white" style="font-size: 6rem;"></i>
                    <h3 class="text-white mt-3 fw-bold">Khan Jahan Ali Hall</h3>
                    <p class="text-white-50">Khulna University of Engineering & Technology</p>
                    <hr class="text-white">
                    <div class="row text-white text-center">
                        <div class="col-4">
                            <i class="bi bi-cup-hot fs-4"></i>
                            <p class="small mt-1">Dining Hall</p>
                        </div>
                        <div class="col-4">
                            <i class="bi bi-book fs-4"></i>
                            <p class="small mt-1">Reading Room</p>
                        </div>
                        <div class="col-4">
                            <i class="bi bi-controller fs-4"></i>
                            <p class="small mt-1">Common Room</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Public Notice Board --}}
<div class="container py-5">
    <h2 class="text-center fw-bold mb-2">Latest Notices</h2>
    <p class="text-center text-muted mb-5">Stay updated with the latest announcements from Khan Jahan Ali Hall</p>
    <div class="row g-4">
        @forelse($notices as $notice)
        <div class="col-md-4">
            <div class="card shadow h-100 border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle p-2 me-3">
                            <i class="bi bi-megaphone text-white"></i>
                        </div>
                        <small class="text-muted">{{ $notice->created_at->format('d M Y') }}</small>
                    </div>
                    <h5 class="fw-bold">{{ $notice->title }}</h5>
                    <p class="text-muted">{{ Str::limit($notice->body, 100) }}</p>
                </div>
                <div class="card-footer bg-white border-0">
                    <small class="text-success"><i class="bi bi-person"></i> Hall Administration</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <i class="bi bi-megaphone fs-1 text-muted"></i>
            <p class="text-muted mt-2">No notices posted yet.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Footer --}}
<footer class="bg-dark text-white text-center py-4">
    <p class="mb-0">© {{ date('Y') }} KUET Hall Management System. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>