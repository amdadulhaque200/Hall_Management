@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-speedometer2"></i> My Dashboard</h3>
@if($student)
<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">My Info</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th>Name</th><td>{{ $student->name }}</td></tr>
                    <tr><th>Border No</th><td><span class="badge bg-primary">{{ $student->border_number }}</span></td></tr>
                    <tr><th>Roll No</th><td>{{ $student->roll_number }}</td></tr>
                    <tr><th>Department</th><td>{{ $student->department }}</td></tr>
                    <tr><th>Session</th><td>{{ $student->session }}</td></tr>
                    <tr><th>Room</th><td>{{ $student->room->room_number ?? 'Not Assigned' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-white">Fee Summary</div>
            <div class="card-body">
                <h4 class="text-danger">
                    Unpaid: {{ $student->fees->where('status', 'unpaid')->count() }} months
                </h4>
                <a href="{{ route('student.fees.index') }}" class="btn btn-warning mt-2">View Details</a>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">Your student profile is not set up yet. Please contact the hall admin.</div>
@endif
@endsection