@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-pencil"></i> Edit Student</h3>
    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.students.update', $student) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $student->name }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control" value="{{ $student->department }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Session</label>
                    <input type="text" name="session" class="form-control" value="{{ $student->session }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Assign Room</label>
                    <select name="room_id" class="form-select">
                        <option value="">-- Select Room --</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $student->room_id == $room->id ? 'selected' : '' }}>
                            Room {{ $room->room_number }} (Floor {{ $room->floor }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i> Update Student
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection