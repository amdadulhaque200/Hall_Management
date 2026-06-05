@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-people"></i> Students</h3>
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Student
    </a>
</div>
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
                <tr><td colspan="8" class="text-center">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection