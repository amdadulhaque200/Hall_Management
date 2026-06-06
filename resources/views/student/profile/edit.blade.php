@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-person-gear"></i> My Profile</h3>

<div class="row g-4">
    {{-- Profile Info --}}
    <div class="col-md-4">
        <div class="card shadow-sm text-center">
            <div class="card-body p-4">
                @if($student->photo)
    <img src="{{ asset('storage/' . $student->photo) }}"
        alt="Profile Photo"
        class="rounded-circle mb-3"
        style="width:80px; height:80px; object-fit:cover;">
@else
    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px; height:80px;">
        <i class="bi bi-person text-white" style="font-size:2.5rem;"></i>
    </div>
@endif
                <h5 class="fw-bold">{{ $student->name }}</h5>
                <p class="text-muted mb-1">{{ $student->department }}</p>
                <span class="badge bg-primary">Border No: {{ $student->border_number }}</span>
                <hr>
                <table class="table table-borderless text-start small">
                    <tr><th>Roll No</th><td>{{ $student->roll_number }}</td></tr>
                    <tr><th>Session</th><td>{{ $student->session }}</td></tr>
                    <tr><th>Room</th><td>{{ $student->room->room_number ?? 'N/A' }}</td></tr>
                    <tr><th>Phone</th><td>{{ $student->phone ?? 'Not set' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                <i class="bi bi-pencil"></i> Update Profile
            </div>
            <div class="card-body p-4">
                <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $student->phone) }}" placeholder="e.g. 01XXXXXXXXX">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    {{-- Profile Photo --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Profile Photo</label>
    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
        accept="image/*">
    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($student->photo)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $student->photo) }}"
                alt="Current Photo"
                style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
            <small class="text-muted ms-2">Current photo</small>
        </div>
    @endif
</div>

                    <hr>
                    <h6 class="fw-bold mb-3">Change Password <span class="text-muted fw-normal small">(leave blank to keep current)</span></h6>

                    {{-- New Password --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter new password">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm new password">
                    </div>

                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check"></i> Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection