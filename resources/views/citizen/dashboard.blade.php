@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@section('styles')
<style>
    /* Specific overrides for Citizen Portal to feel more personal */
    .citizen-header {
        background: white;
        padding: 32px;
        border-radius: 16px;
        margin-bottom: 32px;
        box-shadow: var(--card-shadow);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--border);
    }
    .corpus-card {
        background: linear-gradient(135deg, #FF9933 0%, #003399 50%, #128807 100%);
        color: white;
        padding: 32px;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }
    .corpus-card::after {
        content: '\f51e';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 8rem;
        opacity: 0.1;
    }
    .scheme-card {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .scheme-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="citizen-header">
    <div style="display: flex; align-items: center; gap: 20px;">
        <img src="{{ asset('images/pension_logo.png') }}" style="height: 60px;" alt="Pension Logo">
        <div>
            <h1 style="font-size: 2rem; font-weight: 800; color: var(--secondary); margin-bottom: 4px;">Namaste, Rajesh Kumar</h1>
            <p style="color: var(--text-light); display: flex; align-items: center; gap: 8px;">
                Welcome to your unified pension portal. Your OneID is <span style="color: var(--primary); font-weight: 700;">8829-1033-9421</span>.
                <i class="fas fa-circle-check" style="color: var(--success)"></i>
            </p>
        </div>
    </div>
    <div style="display: flex; gap: 16px;">
        <button class="btn btn-primary" onclick="exportToCSV('payoutTable', 'my_pension_statement')"><i class="fas fa-download"></i> Download Statement</button>
        <button class="btn btn-secondary">Update KYC</button>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 32px; margin-bottom: 32px;">
    <div class="corpus-card">
        <h3 style="font-size: 1rem; opacity: 0.9; margin-bottom: 8px; font-weight: 600;">MY PENSION CORPUS</h3>
        <div style="margin-bottom: 24px;">
            <span style="font-size: 0.875rem; opacity: 0.8;">Total Accumulated Value</span>
            <div style="font-size: 2.5rem; font-weight: 800; letter-spacing: -0.02em;">₹ 42,85,200</div>
            <div style="font-size: 0.875rem; color: #ffffff; font-weight: 600; margin-top: 4px; background: rgba(0,0,0,0.2); display: inline-block; padding: 2px 8px; border-radius: 4px;">
                <i class="fas fa-arrow-trend-up"></i> +4.2% Growth (FY 24-25)
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; background: rgba(255,255,255,0.15); padding: 20px; border-radius: 12px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
            <div>
                <div style="font-size: 0.75rem; opacity: 0.8; margin-bottom: 4px;">Monthly Disbursement</div>
                <div style="font-size: 1.25rem; font-weight: 700;">₹ 34,500</div>
                <div style="font-size: 0.75rem; opacity: 0.7; margin-top: 2px;">Next payout: Oct 01, 2024</div>
            </div>
            <div style="text-align: right; display: flex; align-items: center; justify-content: flex-end;">
                <i class="fas fa-indian-rupee-sign" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px; font-weight: 700; color: var(--secondary);">ACTION CENTER</h3>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; border: 1px solid var(--border); border-radius: 12px; background: #fffbeb;">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <i class="fas fa-file-signature" style="color: #92400e"></i>
                    <span style="font-size: 0.875rem; font-weight: 600;">Life Certificate</span>
                </div>
                <span style="font-size: 0.75rem; color: #92400e">Due in 45 days <i class="fas fa-chevron-right"></i></span>
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; border: 1px solid var(--border); border-radius: 12px;">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <i class="fas fa-id-card" style="color: var(--success)"></i>
                    <span style="font-size: 0.875rem; font-weight: 600;">KYC Update</span>
                </div>
                <span style="font-size: 0.75rem; color: var(--success)">Verified <i class="fas fa-circle-check"></i></span>
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; border: 1px solid var(--border); border-radius: 12px;">
                <div style="display: flex; gap: 12px; align-items: center;">
                    <i class="fas fa-users-gear" style="color: var(--accent)"></i>
                    <span style="font-size: 0.875rem; font-weight: 600;">Nomination</span>
                </div>
                <span style="font-size: 0.75rem; color: var(--text-light)">Update <i class="fas fa-chevron-right"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-bottom: 32px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 1.25rem; font-weight: 700;">Transaction History</h2>
        <a href="#" style="color: var(--primary); font-size: 0.875rem; text-decoration: none; font-weight: 600;">View All</a>
    </div>
    <table id="payoutTable" style="margin-top: 0;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Scheme Name</th>
                <th>Reference Number</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sep 01, 2024</td>
                <td><strong>NPS Tier I</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">PNS-8829-X1</td>
                <td style="font-weight: 700;">₹ 28,500.00</td>
                <td>Direct Benefit</td>
                <td><span class="badge badge-success">Success</span></td>
            </tr>
            <tr>
                <td>Sep 01, 2024</td>
                <td><strong>NSAP Indira Gandhi</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">PNS-8829-X2</td>
                <td style="font-weight: 700;">₹ 6,000.00</td>
                <td>Direct Benefit</td>
                <td><span class="badge badge-success">Success</span></td>
            </tr>
            <tr>
                <td>Aug 01, 2024</td>
                <td><strong>NPS Tier I</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">PNS-8821-A9</td>
                <td style="font-weight: 700;">₹ 28,500.00</td>
                <td>Direct Benefit</td>
                <td><span class="badge badge-success">Success</span></td>
            </tr>
            <tr>
                <td>Aug 01, 2024</td>
                <td><strong>NSAP Indira Gandhi</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">PNS-8821-B0</td>
                <td style="font-weight: 700;">₹ 6,000.00</td>
                <td>Direct Benefit</td>
                <td><span class="badge badge-success">Success</span></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <div class="card">
        <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 20px;">Linked Schemes</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
            <div style="padding: 16px; border: 1px solid var(--border); border-radius: 12px; border-left: 4px solid #FF9933;">
                <h4 style="font-weight: 700;">NPS - Tier I</h4>
                <p style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 12px;">PRAN: 1100****4210</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="badge badge-success">ACTIVE</span>
                    <button class="btn btn-secondary" style="padding: 4px 12px; font-size: 0.75rem;">Manage</button>
                </div>
            </div>
            <div style="padding: 16px; border: 1px solid var(--border); border-radius: 12px; border-left: 4px solid #128807;">
                <h4 style="font-weight: 700;">NSAP Old Age</h4>
                <p style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 12px;">ID: NS-2021-9921</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="badge badge-success">ACTIVE</span>
                    <button class="btn btn-secondary" style="padding: 4px 12px; font-size: 0.75rem;">View</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card" style="background: #f1f5f9; text-align: center;">
        <img src="{{ asset('images/govt_banner.png') }}" style="width: 100%; border-radius: 8px; margin-bottom: 12px;" alt="Banner">
        <h5 style="font-weight: 700;">Help & Support</h5>
        <p style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 12px;">Toll-free: 1800-11-2024</p>
        <button class="btn btn-secondary" style="width: 100%; justify-content: center;">Chat with Assistant</button>
    </div>
</div>
@endsection
