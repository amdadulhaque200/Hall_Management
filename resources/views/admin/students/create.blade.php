@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-person-plus"></i> Add Student</h3>
    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.students.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Border Number</label>
                    <input type="text" name="border_number" class="form-control @error('border_number') is-invalid @enderror" value="{{ old('border_number') }}">
                    @error('border_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Roll Number</label>
                    <input type="text" name="roll_number" class="form-control @error('roll_number') is-invalid @enderror" value="{{ old('roll_number') }}">
                    @error('roll_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}">
                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Session</label>
                    <input type="text" name="session" class="form-control @error('session') is-invalid @enderror" value="{{ old('session') }}" placeholder="e.g. 2021-22">
                    @error('session')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Assign Room</label>
                    <select name="room_id" class="form-select">
                        <option value="">-- Select Room --</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">Room {{ $room->room_number }} (Floor {{ $room->floor }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i> Add Student
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection