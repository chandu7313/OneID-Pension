@extends('layouts.app')

@section('title', 'System Overview')

@section('content')
<div class="header" style="margin-bottom: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <img src="{{ asset('images/pension_logo.png') }}" style="height: 40px;" alt="Pension Logo">
                <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary); margin: 0;">System Overview</h1>
            </div>
            <p style="color: var(--text-light);">Central Administration Hub | Real-time monitoring of OneID Pension Network</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="btn btn-secondary" onclick="location.reload()"><i class="fas fa-sync"></i> Refresh Data</button>
            <button class="btn btn-primary" onclick="exportToCSV('beneficiaryTable', 'beneficiary_report')"><i class="fas fa-file-export"></i> Export Beneficiaries</button>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="card stat-card">
        <h3>Total Beneficiaries</h3>
        <div class="value">14.2M</div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 2.4% <span style="color: var(--text-light)">vs last month</span></div>
    </div>
    <div class="card stat-card">
        <h3>Disbursement Target</h3>
        <div class="value">₹ 4,820 Cr</div>
        <div style="font-size: 0.875rem; color: var(--text-light); margin-top: 8px;">For FY 2024-25 Q2</div>
    </div>
    <div class="card stat-card" style="border-left: 4px solid var(--danger);">
        <h3>Fraud Alerts</h3>
        <div class="value" style="color: var(--danger)">1,204</div>
        <div class="trend down"><i class="fas fa-triangle-exclamation"></i> Action Required</div>
    </div>
    <div class="card stat-card">
        <h3>Identity Sync</h3>
        <div class="value">99.8%</div>
        <div class="trend up" style="color: var(--success)">Aadhaar Verified</div>
    </div>
</div>

<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 1.25rem; font-weight: 700;">Recent Pension Applications</h2>
        <span class="badge badge-warning">Verification in Progress</span>
    </div>
    <table id="beneficiaryTable">
        <thead>
            <tr>
                <th>Reference ID</th>
                <th>Applicant Name</th>
                <th>State/UT</th>
                <th>Scheme Type</th>
                <th>Amount (p.m.)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#APP-2024-001</td>
                <td><strong>Suresh V. Rathod</strong></td>
                <td>Maharashtra</td>
                <td>Old Age Pension</td>
                <td>₹ 3,500</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td><button class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">Verify</button></td>
            </tr>
            <tr>
                <td>#APP-2024-002</td>
                <td><strong>Meena Devi</strong></td>
                <td>Bihar</td>
                <td>Widow Pension</td>
                <td>₹ 2,000</td>
                <td><span class="badge badge-success">Approved</span></td>
                <td><button class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">View</button></td>
            </tr>
            <tr>
                <td>#APP-2024-003</td>
                <td><strong>Amrit Pal Singh</strong></td>
                <td>Punjab</td>
                <td>Disability Pension</td>
                <td>₹ 2,500</td>
                <td><span class="badge badge-success">Approved</span></td>
                <td><button class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">View</button></td>
            </tr>
            <tr>
                <td>#APP-2024-004</td>
                <td><strong>Lakshmi Narayanan</strong></td>
                <td>Tamil Nadu</td>
                <td>Farmer Pension</td>
                <td>₹ 3,000</td>
                <td><span class="badge badge-danger">Rejected</span></td>
                <td><button class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">Details</button></td>
            </tr>
            <tr>
                <td>#APP-2024-005</td>
                <td><strong>Arjun Munda</strong></td>
                <td>Jharkhand</td>
                <td>Tribal Welfare</td>
                <td>₹ 1,500</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td><button class="btn btn-secondary" style="padding: 4px 8px; font-size: 0.75rem;">Verify</button></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <div class="card">
        <h3 style="font-size: 1rem; margin-bottom: 16px;">State-wise Distribution</h3>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div>
                <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 4px;">
                    <span>Uttar Pradesh</span>
                    <span style="font-weight: 700;">₹ 840 Cr</span>
                </div>
                <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 4px;">
                    <div style="width: 85%; height: 100%; background: #FF9933; border-radius: 4px;"></div>
                </div>
            </div>
            <div>
                <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 4px;">
                    <span>Karnataka</span>
                    <span style="font-weight: 700;">₹ 620 Cr</span>
                </div>
                <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 4px;">
                    <div style="width: 65%; height: 100%; background: #128807; border-radius: 4px;"></div>
                </div>
            </div>
            <div>
                <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 4px;">
                    <span>Gujarat</span>
                    <span style="font-weight: 700;">₹ 580 Cr</span>
                </div>
                <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 4px;">
                    <div style="width: 60%; height: 100%; background: var(--primary); border-radius: 4px;"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
        <img src="{{ asset('images/govt_banner.png') }}" style="width: 100%; max-height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 16px;" alt="Banner">
        <h4 style="font-weight: 700;">Pensioners Day 2024</h4>
        <p style="font-size: 0.875rem; color: var(--text-light);">Registration open for national felicitation ceremony.</p>
    </div>
</div>
@endsection
