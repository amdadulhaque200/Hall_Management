@extends('layouts.admin')
@section('content')
<h3 class="mb-4"><i class="bi bi-chat-dots"></i> Complaints</h3>
<div class="card">
    <div class="card-body">
        @forelse($complaints as $complaint)
        <div class="border rounded p-3 mb-3">
            <div class="d-flex justify-content-between">
                <h6>{{ $complaint->subject }}</h6>
                <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : 'warning' }}">
                    {{ ucfirst($complaint->status) }}
                </span>
            </div>
            <p class="mb-1"><strong>Student:</strong> {{ $complaint->student->name }} ({{ $complaint->student->border_number }})</p>
            <p class="mb-2">{{ $complaint->message }}</p>
            @if($complaint->admin_reply)
                <div class="alert alert-success py-2">
                    <strong>Your Reply:</strong> {{ $complaint->admin_reply }}
                </div>
            @else
            <form action="{{ route('admin.complaints.reply', $complaint) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="admin_reply" class="form-control" placeholder="Write reply...">
                    <button class="btn btn-primary" type="submit">Reply</button>
                </div>
            </form>
            @endif
            <small class="text-muted">{{ $complaint->created_at->format('d M Y') }}</small>
        </div>
        @empty
        <p class="text-center">No complaints found.</p>
        @endforelse
    </div>
</div>
@endsection