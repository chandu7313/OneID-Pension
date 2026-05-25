@extends('layouts.app')

@section('title', 'Disbursements')

@section('content')
<div class="header" style="margin-bottom: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary);">Pension Disbursements</h1>
            <p style="color: var(--text-light);">Manage payment cycles, DBT transfers, and successful credit confirmations.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="btn btn-primary"><i class="fas fa-money-check-dollar"></i> Initialize Cycle</button>
            <button class="btn btn-secondary">Download Bank Sheet</button>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="card stat-card">
        <h3>Current Cycle Budget</h3>
        <div class="value">₹124.5 Cr</div>
        <div style="font-size: 0.875rem; color: var(--text-light); margin-top: 8px;">For October 2024</div>
    </div>
    <div class="card stat-card">
        <h3>DBT Success Rate</h3>
        <div class="value" style="color: var(--success)">99.4%</div>
        <div class="trend up"><i class="fas fa-check"></i> Within SLA</div>
    </div>
    <div class="card stat-card">
        <h3>Failed Transfers</h3>
        <div class="value" style="color: var(--danger)">402</div>
        <div class="trend down" style="cursor: pointer;">Review & Retry <i class="fas fa-chevron-right"></i></div>
    </div>
</div>

<div class="card">
    <h3 style="font-size: 1.1rem; margin-bottom: 20px;">Recent Disbursement Batches</h3>
    <table>
        <thead>
            <tr>
                <th>Batch ID</th>
                <th>Scheme Name</th>
                <th>Beneficiaries</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: 600;">BTCH-2024-0901</td>
                <td>Old Age Pension (Central)</td>
                <td>84,200</td>
                <td>₹28.4 Cr</td>
                <td><span class="badge badge-success">Completed</span></td>
                <td>Sep 01, 2024</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">BTCH-2024-0902</td>
                <td>Widow Pension (State)</td>
                <td>12,100</td>
                <td>₹6.2 Cr</td>
                <td><span class="badge badge-success">Completed</span></td>
                <td>Sep 01, 2024</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">BTCH-2024-1001</td>
                <td>Disability Support</td>
                <td>5,400</td>
                <td>₹2.1 Cr</td>
                <td><span class="badge badge-warning">Processing</span></td>
                <td>Oct 01, 2024</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
