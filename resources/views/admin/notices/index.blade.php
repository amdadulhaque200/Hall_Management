@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-megaphone"></i> Notices</h3>
    <a href="{{ route('admin.notices.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Post Notice
    </a>
</div>
<div class="card">
    <div class="card-body">
        @forelse($notices as $notice)
        <div class="border rounded p-3 mb-3">
            <div class="d-flex justify-content-between">
                <h5>{{ $notice->title }}</h5>
                <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this notice?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
            <p class="text-muted">{{ $notice->body }}</p>
            <small class="text-muted">Posted: {{ $notice->created_at->format('d M Y, h:i A') }}</small>
        </div>
        @empty
        <p class="text-center">No notices posted yet.</p>
        @endforelse
    </div>
</div>
@endsection