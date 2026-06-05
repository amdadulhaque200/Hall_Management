@extends('layouts.student')
@section('content')
<h3 class="mb-4"><i class="bi bi-cash"></i> My Fees</h3>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ DateTime::createFromFormat('!m', $fee->month)->format('F') }}</td>
                    <td>{{ $fee->year }}</td>
                    <td>{{ number_format($fee->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $fee->status == 'paid' ? 'success' : 'danger' }}">
                            {{ ucfirst($fee->status) }}
                        </span>
                    </td>
                    <td>{{ $fee->paid_at ? \Carbon\Carbon::parse($fee->paid_at)->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">No fee records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection