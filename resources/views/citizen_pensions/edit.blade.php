@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Edit Pension Assignment: {{ $citizenPension->enrollment_number }}</h2>
    <a href="{{ route('citizen-pensions.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('citizen-pensions.update', $citizenPension) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Select Citizen <span class="text-danger">*</span></label>
                    <select name="citizen_id" class="form-select @error('citizen_id') is-invalid @enderror" required>
                        <option value="">Choose Citizen...</option>
                        @foreach($citizens as $citizen)
                            <option value="{{ $citizen->id }}" {{ old('citizen_id', $citizenPension->citizen_id) == $citizen->id ? 'selected' : '' }}>
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
                            <option value="{{ $scheme->id }}" {{ old('pension_scheme_id', $citizenPension->pension_scheme_id) == $scheme->id ? 'selected' : '' }}>
                                {{ $scheme->scheme_name }} - ${{ number_format($scheme->benefit_amount, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Enrollment Number <span class="text-danger">*</span></label>
                    <input type="text" name="enrollment_number" class="form-control @error('enrollment_number') is-invalid @enderror" value="{{ old('enrollment_number', $citizenPension->enrollment_number) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $citizenPension->start_date) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="pension_status" class="form-select">
                        <option value="Pending" {{ old('pension_status', $citizenPension->pension_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Active" {{ old('pension_status', $citizenPension->pension_status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Suspended" {{ old('pension_status', $citizenPension->pension_status) == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Benefit Amount ($) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="benefit_amount" class="form-control @error('benefit_amount') is-invalid @enderror" value="{{ old('benefit_amount', $citizenPension->benefit_amount) }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Assignment</button>
            <a href="{{ route('citizen-pensions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
