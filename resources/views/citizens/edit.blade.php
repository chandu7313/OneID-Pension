@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Edit Citizen: {{ $citizen->full_name }}</h2>
    <a href="{{ route('citizens.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('citizens.update', $citizen) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name', $citizen->full_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Aadhaar Number <span class="text-danger">*</span></label>
                    <input type="text" name="aadhaar_number" class="form-control @error('aadhaar_number') is-invalid @enderror" value="{{ old('aadhaar_number', $citizen->aadhaar_number) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $citizen->mobile_number) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $citizen->email) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $citizen->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $citizen->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $citizen->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $citizen->dob) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pension Status</label>
                    <select name="pension_status" class="form-select">
                        <option value="None" {{ old('pension_status', $citizen->pension_status) == 'None' ? 'selected' : '' }}>None</option>
                        <option value="Pending" {{ old('pension_status', $citizen->pension_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Active" {{ old('pension_status', $citizen->pension_status) == 'Active' ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">State <span class="text-danger">*</span></label>
                    <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $citizen->state) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">District</label>
                    <input type="text" name="district" class="form-control" value="{{ old('district', $citizen->district) }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Full Address</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $citizen->address) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Citizen</button>
            <a href="{{ route('citizens.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
