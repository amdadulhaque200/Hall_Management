@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-people"></i> Students</h3>
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Student
    </a>
</div>

{{-- Search & Filter --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.students.index') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name or border number..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="department" class="form-control"
                        placeholder="Filter by department..."
                        value="{{ request('department') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="session" class="form-control"
                        placeholder="Filter by session..."
                        value="{{ request('session') }}">
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Search
                        </button>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Results count --}}
<p class="text-muted mb-3">
    Showing <strong>{{ $students->count() }}</strong> student(s)
    @if(request('search') || request('department') || request('session'))
        for your search
        @if(request('search'))<span class="badge bg-primary ms-1">{{ request('search') }}</span>@endif
        @if(request('department'))<span class="badge bg-success ms-1">{{ request('department') }}</span>@endif
        @if(request('session'))<span class="badge bg-warning ms-1">{{ request('session') }}</span>@endif
    @endif
</p>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Border No</th>
                    <th>Roll No</th>
                    <th>Department</th>
                    <th>Session</th>
                    <th>Room</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td><span class="badge bg-primary">{{ $student->border_number }}</span></td>
                    <td>{{ $student->roll_number }}</td>
                    <td>{{ $student->department }}</td>
                    <td>{{ $student->session }}</td>
                    <td>{{ $student->room->room_number ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <i class="bi bi-search fs-1 text-muted"></i>
                        <p class="text-muted mt-2">No students found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection