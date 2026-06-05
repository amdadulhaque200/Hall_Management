@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-megaphone"></i> Notices</h3>

@forelse($notices as $notice)
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="bg-success rounded-circle p-2 me-3">
                <i class="bi bi-megaphone text-white"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold">{{ $notice->title }}</h5>
                <small class="text-muted">{{ $notice->created_at->format('d M Y, h:i A') }}</small>
            </div>
        </div>
        <p class="text-muted mb-0">{{ $notice->body }}</p>
    </div>
    <div class="card-footer bg-white border-0">
        <small class="text-success"><i class="bi bi-person"></i> Hall Administration</small>
    </div>
</div>
@empty
<div class="text-center py-5">
    <i class="bi bi-megaphone fs-1 text-muted"></i>
    <p class="text-muted mt-2">No notices posted yet.</p>
</div>
@endforelse
@endsection