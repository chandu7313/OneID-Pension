@extends('layouts.app')

@section('title', 'My Certificates')

@section('content')
<div class="header" style="margin-bottom: 32px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--secondary);">Digital Certificates</h1>
    <p style="color: var(--text-light);">Securely access and download your pension-related government certificates.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    <!-- Life Certificate -->
    <div class="card" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #dcfce7; color: #15803d; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-heart-pulse"></i>
            </div>
            <span class="badge badge-success">ACTIVE</span>
        </div>
        <div>
            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 4px;">Life Certificate (Jeevan Pramaan)</h3>
            <p style="font-size: 0.875rem; color: var(--text-light);">Submitted via Aadhaar Biometrics on Aug 15, 2024.</p>
        </div>
        <div style="padding-top: 12px; border-top: 1px solid var(--border); display: flex; gap: 12px;">
            <button class="btn btn-primary" onclick="showNotification('Downloading Life Certificate...')"><i class="fas fa-file-pdf"></i> Download</button>
            <button class="btn btn-secondary">View Details</button>
        </div>
    </div>

    <!-- Pension Entitlement -->
    <div class="card" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #e0f2fe; color: #0369a1; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-certificate"></i>
            </div>
            <span class="badge badge-success">VERIFIED</span>
        </div>
        <div>
            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 4px;">Pension Entitlement Card</h3>
            <p style="font-size: 0.875rem; color: var(--text-light);">Official OneID digital entitlement record.</p>
        </div>
        <div style="padding-top: 12px; border-top: 1px solid var(--border); display: flex; gap: 12px;">
            <button class="btn btn-primary" onclick="showNotification('Downloading Entitlement Card...')"><i class="fas fa-file-pdf"></i> Download</button>
            <button class="btn btn-secondary">View Details</button>
        </div>
    </div>

    <!-- Income Certificate -->
    <div class="card" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #fef3c7; color: #b45309; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-indian-rupee-sign"></i>
            </div>
            <span class="badge badge-warning">RENEWAL DUE</span>
        </div>
        <div>
            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 4px;">Income Declaration</h3>
            <p style="font-size: 0.875rem; color: var(--text-light);">Last declared: Jan 2024. Next due: Jan 2025.</p>
        </div>
        <div style="padding-top: 12px; border-top: 1px solid var(--border); display: flex; gap: 12px;">
            <button class="btn btn-primary" onclick="showNotification('Downloading Income Declaration...')"><i class="fas fa-file-pdf"></i> Download</button>
            <button class="btn btn-secondary">Renew Now</button>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 32px; background: #f8fafc; border: 1px dashed var(--border); text-align: center; padding: 48px;">
    <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 16px;">
        <i class="fas fa-cloud-arrow-up"></i>
    </div>
    <h3 style="font-weight: 700; color: var(--secondary);">Need to upload a new document?</h3>
    <p style="color: var(--text-light); margin-bottom: 24px;">Upload scanned copies of your bank passbook or identity proofs.</p>
    <button class="btn btn-secondary" style="margin: 0 auto;"><i class="fas fa-plus"></i> Upload Document</button>
</div>
@endsection
