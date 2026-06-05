@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-chat-dots"></i> My Complaints</h3>
<div class="card mb-4">
    <div class="card-header">Submit New Complaint</div>
    <div class="card-body">
        <form action="{{ route('student.complaints.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Submit Complaint
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">My Complaints</div>
    <div class="card-body">
        @forelse($complaints as $complaint)
        <div class="border rounded p-3 mb-3">
            <div class="d-flex justify-content-between">
                <h6>{{ $complaint->subject }}</h6>
                <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : 'warning' }}">
                    {{ ucfirst($complaint->status) }}
                </span>
            </div>
            <p>{{ $complaint->message }}</p>
            @if($complaint->admin_reply)
            <div class="alert alert-success py-2">
                <strong>Admin Reply:</strong> {{ $complaint->admin_reply }}
            </div>
            @endif
            <small class="text-muted">{{ $complaint->created_at->format('d M Y') }}</small>
        </div>
        @empty
        <p class="text-center">No complaints submitted yet.</p>
        @endforelse
    </div>
</div>
@endsection
