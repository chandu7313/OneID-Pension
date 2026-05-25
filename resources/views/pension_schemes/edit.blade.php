@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Edit Pension Scheme: {{ $pensionScheme->scheme_name }}</h2>
    <a href="{{ route('pension-schemes.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pension-schemes.update', $pensionScheme) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Scheme Name <span class="text-danger">*</span></label>
                    <input type="text" name="scheme_name" class="form-control @error('scheme_name') is-invalid @enderror" value="{{ old('scheme_name', $pensionScheme->scheme_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Scheme Code <span class="text-danger">*</span></label>
                    <input type="text" name="scheme_code" class="form-control @error('scheme_code') is-invalid @enderror" value="{{ old('scheme_code', $pensionScheme->scheme_code) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Scheme Type</label>
                    <input type="text" name="scheme_type" class="form-control" value="{{ old('scheme_type', $pensionScheme->scheme_type) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Provider Type</label>
                    <select name="provider_type" class="form-select">
                        <option value="">Select Provider</option>
                        <option value="Government" {{ old('provider_type', $pensionScheme->provider_type) == 'Government' ? 'selected' : '' }}>Government</option>
                        <option value="Private" {{ old('provider_type', $pensionScheme->provider_type) == 'Private' ? 'selected' : '' }}>Private</option>
                        <option value="NGO" {{ old('provider_type', $pensionScheme->provider_type) == 'NGO' ? 'selected' : '' }}>NGO</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Benefit Amount ($) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="benefit_amount" class="form-control @error('benefit_amount') is-invalid @enderror" value="{{ old('benefit_amount', $pensionScheme->benefit_amount) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Active" {{ old('status', $pensionScheme->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Draft" {{ old('status', $pensionScheme->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Inactive" {{ old('status', $pensionScheme->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Eligibility Criteria</label>
                <textarea name="eligibility_criteria" class="form-control" rows="3">{{ old('eligibility_criteria', $pensionScheme->eligibility_criteria) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Scheme</button>
            <a href="{{ route('pension-schemes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
