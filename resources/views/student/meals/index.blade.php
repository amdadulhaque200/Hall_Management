@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-cup-hot"></i> Meal Management</h3>
<div class="card mb-4">
    <div class="card-body text-center">
        <h5>Tomorrow's Meal Status</h5>
        @php
            $tomorrow = now()->addDay()->toDateString();
            $tomorrowMeal = $meals->where('date', $tomorrow)->first();
            $status = $tomorrowMeal ? $tomorrowMeal->status : 'on';
        @endphp
        <span class="badge bg-{{ $status == 'on' ? 'success' : 'danger' }} fs-5 mb-3">
            Meal {{ strtoupper($status) }}
        </span>
        <br>
        <form action="{{ route('student.meals.toggle') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-{{ $status == 'on' ? 'danger' : 'success' }} mt-2">
                {{ $status == 'on' ? 'Turn OFF Meal' : 'Turn ON Meal' }}
            </button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">Meal History</div>
    <div class="card-body">
        <table class="table">
            <thead class="table-dark">
                <tr><th>Date</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($meals as $meal)
                <tr>
                    <td>{{ $meal->date }}</td>
                    <td><span class="badge bg-{{ $meal->status == 'on' ? 'success' : 'danger' }}">{{ strtoupper($meal->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="2" class="text-center">No meal records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection