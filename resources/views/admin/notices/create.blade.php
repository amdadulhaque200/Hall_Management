@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-plus-circle"></i> Post Notice</h3>
    <a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.notices.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Body</label>
                    <textarea name="body" rows="6" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Post Notice
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection