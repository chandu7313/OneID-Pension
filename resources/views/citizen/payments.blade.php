@extends('layouts.app')

@section('title', 'My Payments')

@section('content')
<div class="header" style="margin-bottom: 32px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--secondary);">My Pension Payments</h1>
    <p style="color: var(--text-light);">Detailed history of all disbursements and credit status linked to your OneID.</p>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; font-weight: 700;">Payment History</h2>
        <button class="btn btn-primary" onclick="exportToCSV('paymentsTable', 'my_pension_payments')"><i class="fas fa-file-csv"></i> Export to CSV</button>
    </div>
    <table id="paymentsTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Scheme Name</th>
                <th>Reference ID</th>
                <th>Amount</th>
                <th>Bank Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Oct 01, 2024</td>
                <td><strong>NPS Tier I</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">TXN10293847</td>
                <td style="font-weight: 700;">₹ 28,500.00</td>
                <td><span class="badge badge-success">Credited</span></td>
            </tr>
            <tr>
                <td>Sep 01, 2024</td>
                <td><strong>NPS Tier I</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">TXN09182736</td>
                <td style="font-weight: 700;">₹ 28,500.00</td>
                <td><span class="badge badge-success">Credited</span></td>
            </tr>
            <tr>
                <td>Sep 01, 2024</td>
                <td><strong>NSAP Old Age</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">TXN09182737</td>
                <td style="font-weight: 700;">₹ 6,000.00</td>
                <td><span class="badge badge-success">Credited</span></td>
            </tr>
            <tr>
                <td>Aug 01, 2024</td>
                <td><strong>NPS Tier I</strong></td>
                <td style="font-family: monospace; color: var(--text-light)">TXN08112233</td>
                <td style="font-weight: 700;">₹ 28,500.00</td>
                <td><span class="badge badge-success">Credited</span></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="margin-top: 32px; padding: 24px; background: #f1f5f9; border-radius: 16px; display: flex; align-items: center; gap: 20px;">
    <div style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
        <i class="fas fa-circle-info"></i>
    </div>
    <div>
        <h4 style="font-weight: 700;">Missing a payment?</h4>
        <p style="font-size: 0.875rem; color: var(--text-light);">If your expected pension has not been credited within 5 working days of the scheduled date, please raise a grievance.</p>
        <a href="{{ url('/citizen/grievances') }}" style="color: var(--primary); font-weight: 600; font-size: 0.875rem; text-decoration: none;">Raise Grievance <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
@endsection
