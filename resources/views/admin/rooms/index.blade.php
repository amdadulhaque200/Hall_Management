@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-door-open"></i> Rooms</h3>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Room
    </a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Room Number</th>
                    <th>Floor</th>
                    <th>Capacity</th>
                    <th>Occupied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->floor }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>
                        <span class="badge bg-{{ $room->students_count >= $room->capacity ? 'danger' : 'success' }}">
                            {{ $room->students_count }}/{{ $room->capacity }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this room?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">No rooms found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection