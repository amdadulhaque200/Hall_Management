@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-plus-circle"></i> Add Fee Record</h3>
    <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.fees.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-select">
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->border_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <select name="month" class="form-select">
                        @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" step="0.01">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i> Add Fee Record
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection