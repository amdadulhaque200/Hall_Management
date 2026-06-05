@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-cash"></i> Fee Records</h3>
    <a href="{{ route('admin.fees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Fee
    </a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Border No</th>
                    <th>Month/Year</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fee->student->name }}</td>
                    <td>{{ $fee->student->border_number }}</td>
                    <td>{{ DateTime::createFromFormat('!m', $fee->month)->format('F') }} {{ $fee->year }}</td>
                    <td>{{ number_format($fee->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $fee->status == 'paid' ? 'success' : 'danger' }}">
                            {{ ucfirst($fee->status) }}
                        </span>
                    </td>
                    <td>
                        @if($fee->status == 'unpaid')
                        <form action="{{ route('admin.fees.markPaid', $fee) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">
                                <i class="bi bi-check"></i> Mark Paid
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">No fee records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection