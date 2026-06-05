@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-cup-hot"></i> Meal Report</h3>
    <button onclick="printMealList()" class="btn btn-dark">
        <i class="bi bi-printer"></i> Print Tomorrow's Meal List
    </button>
</div>

{{-- Today & Tomorrow Stats --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-cup-hot fs-1"></i>
                <h5 class="mt-2">Today — Meal ON</h5>
                <h2>{{ $todayOn }}</h2>
                <small>{{ $today }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <i class="bi bi-x-circle fs-1"></i>
                <h5 class="mt-2">Today — Meal OFF</h5>
                <h2>{{ $todayOff }}</h2>
                <small>{{ $today }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-cup-hot fs-1"></i>
                <h5 class="mt-2">Tomorrow — Meal ON</h5>
                <h2>{{ $tomorrowOn }}</h2>
                <small>{{ $tomorrow }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="bi bi-x-circle fs-1"></i>
                <h5 class="mt-2">Tomorrow — Meal OFF</h5>
                <h2>{{ $tomorrowOff }}</h2>
                <small>{{ $tomorrow }}</small>
            </div>
        </div>
    </div>
</div>

{{-- Summary Bar --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Tomorrow's Meal Participation</h6>
        @php
            $percent = $totalStudents > 0 ? round(($tomorrowOn / $totalStudents) * 100) : 0;
        @endphp
        <div class="d-flex justify-content-between mb-1">
            <span>{{ $tomorrowOn }} students having meal</span>
            <span>{{ $percent }}%</span>
        </div>
        <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-success" style="width: {{ $percent }}%">{{ $percent }}%</div>
        </div>
        <small class="text-muted">Total Students: {{ $totalStudents }}</small>
    </div>
</div>

{{-- Recent Meal Records --}}
<div class="card">
    <div class="card-header fw-bold">
        <i class="bi bi-clock-history"></i> Recent Meal Records
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Border No</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMeals as $meal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $meal->student->name }}</td>
                    <td>{{ $meal->student->border_number }}</td>
                    <td>{{ $meal->date }}</td>
                    <td>
                        <span class="badge bg-{{ $meal->status == 'on' ? 'success' : 'danger' }}">
                            {{ strtoupper($meal->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">No meal records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Print Area (hidden on screen) --}}
<div id="printArea" style="display:none;">
    <div style="text-align:center; margin-bottom: 20px;">
        <h2>Khan Jahan Ali Hall</h2>
        <h4>Khulna University of Engineering & Technology</h4>
        <h3>Meal List — {{ $tomorrow }}</h3>
        <p>Total Having Meal: {{ $tomorrowOn }} students</p>
        <hr>
    </div>
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #1a472a; color: white;">
                <th style="padding: 8px; border: 1px solid #ddd;">#</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Student Name</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Border No</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Room</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentMeals->where('date', $tomorrow) as $meal)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $loop->iteration }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $meal->student->name }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $meal->student->border_number }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $meal->student->room->room_number ?? 'N/A' }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ strtoupper($meal->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 40px; text-align: right;">
        <p>Printed on: {{ now()->format('d M Y, h:i A') }}</p>
        <br><br>
        <p>____________________</p>
        <p>Hall Provost Signature</p>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        #printArea, #printArea * { visibility: visible; }
        #printArea { position: absolute; left: 0; top: 0; width: 100%; display: block !important; }
    }
</style>

<script>
    function printMealList() {
        document.getElementById('printArea').style.display = 'block';
        window.print();
        document.getElementById('printArea').style.display = 'none';
    }
</script>
@endsection