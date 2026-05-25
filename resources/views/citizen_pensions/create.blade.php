@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Assign Pension Scheme</h2>
    <a href="{{ route('citizen-pensions.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('citizen-pensions.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Select Citizen <span class="text-danger">*</span></label>
                    <select name="citizen_id" class="form-select @error('citizen_id') is-invalid @enderror" required>
                        <option value="">Choose Citizen...</option>
                        @foreach($citizens as $citizen)
                            <option value="{{ $citizen->id }}" {{ old('citizen_id') == $citizen->id ? 'selected' : '' }}>
                                {{ $citizen->full_name }} ({{ $citizen->aadhaar_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Scheme <span class="text-danger">*</span></label>
                    <select name="pension_scheme_id" class="form-select @error('pension_scheme_id') is-invalid @enderror" required>
                        <option value="">Choose Scheme...</option>
                        @foreach($schemes as $scheme)
                            <option value="{{ $scheme->id }}" {{ old('pension_scheme_id') == $scheme->id ? 'selected' : '' }}>
                                {{ $scheme->scheme_name }} - ${{ number_format($scheme->benefit_amount, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Enrollment Number <span class="text-danger">*</span></label>
                    <input type="text" name="enrollment_number" class="form-control @error('enrollment_number') is-invalid @enderror" value="{{ old('enrollment_number') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Benefit Amount ($) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="benefit_amount" class="form-control @error('benefit_amount') is-invalid @enderror" value="{{ old('benefit_amount') }}" required>
                    <small class="text-muted">You can adjust the standard scheme amount if necessary.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Assignment</button>
            <a href="{{ route('citizen-pensions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
