@extends('layouts.admin')
@section('content')
<h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h3>

{{-- Stats Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Students</h5>
                <h2>{{ $totalStudents }}</h2>
                <i class="bi bi-people fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Total Rooms</h5>
                <h2>{{ $totalRooms }}</h2>
                <i class="bi bi-door-open fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Pending Fees</h5>
                <h2>{{ $pendingFees }}</h2>
                <i class="bi bi-cash fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Pending Complaints</h5>
                <h2>{{ $pendingComplaints }}</h2>
                <i class="bi bi-chat-dots fs-1"></i>
            </div>
        </div>
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-4">
    {{-- Fee Status Chart --}}
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-pie-chart"></i> Fee Status Overview
            </div>
            <div class="card-body">
                <canvas id="feeChart" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Room Occupancy Chart --}}
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-bar-chart"></i> Room Occupancy
            </div>
            <div class="card-body">
                <canvas id="roomChart" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Monthly Fees Bar Chart --}}
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-graph-up"></i> Monthly Fee Collection ({{ date('Y') }})
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Department Chart --}}
<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-bar-chart"></i> Students by Department
        </div>
        <div class="card-body">
            @if(count($departmentLabels) > 0)
                <canvas id="deptChart" height="80"></canvas>
            @else
                <p class="text-center text-muted py-3">No students added yet.</p>
            @endif
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Fee Status Pie Chart
    const feeCtx = document.getElementById('feeChart').getContext('2d');
    new Chart(feeCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
                data: [{{ $paidFees }}, {{ $pendingFees }}],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Room Occupancy Bar Chart
    const roomCtx = document.getElementById('roomChart').getContext('2d');
    new Chart(roomCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($roomLabels) !!},
            datasets: [{
                label: 'Occupied',
                data: {!! json_encode($roomOccupied) !!},
                backgroundColor: '#3498db'
            }, {
                label: 'Capacity',
                data: {!! json_encode($roomCapacity) !!},
                backgroundColor: '#e0e0e0'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Monthly Fee Collection
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Fees Collected (৳)',
                data: {!! json_encode($monthlyFees) !!},
                backgroundColor: '#1a472a',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Department wise student chart
const deptCtx = document.getElementById('deptChart').getContext('2d');
new Chart(deptCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($departmentLabels) !!},
        datasets: [{
            label: 'Students',
            data: {!! json_encode($departmentCounts) !!},
            backgroundColor: [
                '#1a472a','#2c3e50','#3498db',
                '#e74c3c','#f39c12','#9b59b6',
                '#1abc9c','#e67e22','#34495e'
            ],
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
@endsection