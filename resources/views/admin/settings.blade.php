@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="header" style="margin-bottom: 24px;">
    <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary);">System Settings</h1>
    <p style="color: var(--text-light);">Configure platform security, API integrations, and administrative roles.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px;"><i class="fas fa-shield-halved"></i> Security & Encryption</h3>
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600;">Aadhaar Data Masking</div>
                    <div style="font-size: 0.875rem; color: var(--text-light)">Mask PII for non-verification officers</div>
                </div>
                <div style="width: 44px; height: 24px; background: var(--primary); border-radius: 12px; position: relative;">
                    <div style="width: 18px; height: 18px; background: white; border-radius: 50%; position: absolute; right: 3px; top: 3px;"></div>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600;">Multi-Factor Authentication</div>
                    <div style="font-size: 0.875rem; color: var(--text-light)">Require OTP for all admin logins</div>
                </div>
                <div style="width: 44px; height: 24px; background: var(--primary); border-radius: 12px; position: relative;">
                    <div style="width: 18px; height: 18px; background: white; border-radius: 50%; position: absolute; right: 3px; top: 3px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px;"><i class="fas fa-plug"></i> API Integrations</h3>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="padding: 12px; border: 1px solid var(--border); border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-fingerprint" style="color: var(--primary)"></i>
                    <span>UIDAI / Aadhaar Bridge</span>
                </div>
                <span style="color: var(--success); font-size: 0.75rem; font-weight: 700;">CONNECTED</span>
            </div>
            <div style="padding: 12px; border: 1px solid var(--border); border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-building-columns" style="color: var(--primary)"></i>
                    <span>NPCI / DBT Gateway</span>
                </div>
                <span style="color: var(--success); font-size: 0.75rem; font-weight: 700;">CONNECTED</span>
            </div>
        </div>
    </div>
</div>
@endsection
