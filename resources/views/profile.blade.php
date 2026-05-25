@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="header" style="margin-bottom: 24px;">
    <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary);">My Profile</h1>
    <p style="color: var(--text-light);">Manage your personal information and identity records.</p>
</div>

<div style="display: grid; grid-template-columns: 300px 1fr; gap: 32px;">
    <div class="card" style="text-align: center;">
        <img src="https://ui-avatars.com/api/?name={{ Request::is('admin*') ? 'A+Sharma' : 'Rajesh+Kumar' }}&background=003399&color=fff&size=128" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 16px; border: 4px solid var(--primary-light);">
        <h2 style="font-size: 1.25rem;">{{ Request::is('admin*') ? 'A. Sharma' : 'Rajesh Kumar' }}</h2>
        <p style="color: var(--text-light); font-size: 0.875rem; margin-bottom: 24px;">{{ Request::is('admin*') ? 'Lead Auditor' : 'Verified Citizen' }}</p>
        
        <div style="text-align: left; border-top: 1px solid var(--border); padding-top: 24px;">
            <div style="margin-bottom: 16px;">
                <label style="font-size: 0.75rem; color: var(--text-light); text-transform: uppercase;">OneID Number</label>
                <div style="font-weight: 700; color: var(--primary);">ID-8829-1022-4412</div>
            </div>
            <div style="margin-bottom: 16px;">
                <label style="font-size: 0.75rem; color: var(--text-light); text-transform: uppercase;">Aadhaar Status</label>
                <div style="color: var(--success); font-weight: 600;"><i class="fas fa-circle-check"></i> Verified</div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 24px;">Personal Information</h3>
        <form style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-light);">Full Name</label>
                <input type="text" value="{{ Request::is('admin*') ? 'A. Sharma' : 'Rajesh Kumar' }}" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px;" readonly>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-light);">Mobile Number</label>
                <input type="text" value="+91 98765 43210" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px;">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-light);">Email Address</label>
                <input type="email" value="rajesh.k@example.com" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px;">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-light);">Address</label>
                <input type="text" value="Flat 402, Sector 4, Vashi, Navi Mumbai, MH" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px;">
            </div>
        </form>
        <div style="margin-top: 32px; display: flex; justify-content: flex-end; gap: 16px;">
            <button class="btn btn-secondary">Cancel</button>
            <button class="btn btn-primary">Save Changes</button>
        </div>
    </div>
</div>
@endsection
