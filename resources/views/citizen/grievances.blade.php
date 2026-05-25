@extends('layouts.app')

@section('title', 'Grievances & Support')

@section('content')
<div class="header" style="margin-bottom: 32px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--secondary);">Grievance Redressal</h1>
    <p style="color: var(--text-light);">Track your existing complaints or register a new one for official review.</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px;">
    <!-- New Grievance Form -->
    <div class="card">
        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 24px;">Register New Grievance</h3>
        <form onsubmit="event.preventDefault(); showNotification('Grievance registered successfully. Ref: GR-2024-X99');">
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 8px;">Grievance Category</label>
                <select style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; outline: none; background: white;">
                    <option>Payment Delay</option>
                    <option>Wrong Amount Credited</option>
                    <option>KYC Verification Issue</option>
                    <option>Profile Data Correction</option>
                    <option>Other</option>
                </select>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 8px;">Description</label>
                <textarea rows="5" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; outline: none;" placeholder="Explain your issue in detail..."></textarea>
            </div>
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 8px;">Upload Supporting Document (Optional)</label>
                <input type="file" style="width: 100%; padding: 8px; border: 1px solid var(--border); border-radius: 8px;">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Submit Grievance</button>
        </form>
    </div>

    <!-- Active Grievances -->
    <div class="card">
        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 24px;">Recent Grievances</h3>
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="padding: 20px; border: 1px solid var(--border); border-radius: 12px; background: #f8fafc;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                    <div>
                        <span style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase;">REF: GR-2024-X42</span>
                        <h4 style="font-weight: 700; margin: 4px 0;">Delayed October Installment</h4>
                    </div>
                    <span class="badge badge-warning">IN PROGRESS</span>
                </div>
                <p style="font-size: 0.875rem; color: var(--text-light); margin-bottom: 16px;">"My pension for the month of October has not been credited yet despite the status showing processed."</p>
                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: var(--text-light);">
                    <span>Submitted on: Oct 05, 2024</span>
                    <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none;">View Resolution Log</a>
                </div>
            </div>

            <div style="padding: 20px; border: 1px solid var(--border); border-radius: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                    <div>
                        <span style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase;">REF: GR-2024-A11</span>
                        <h4 style="font-weight: 700; margin: 4px 0;">Aadhaar Link Correction</h4>
                    </div>
                    <span class="badge badge-success">RESOLVED</span>
                </div>
                <p style="font-size: 0.875rem; color: var(--text-light); margin-bottom: 16px;">"Requesting correction of the last two digits of my linked Aadhaar card in the portal."</p>
                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: var(--text-light);">
                    <span>Submitted on: Sep 12, 2024</span>
                    <span style="color: var(--success); font-weight: 600;">Closed on: Sep 15, 2024</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
