@extends('layouts.app')

@section('title', 'Beneficiary Management')

@section('content')
<div class="header" style="margin-bottom: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary);">Beneficiary Management</h1>
            <p style="color: var(--text-light);">Oversee and verify citizen pension profiles with real-time Aadhaar integration.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="btn btn-secondary"><i class="fas fa-file-pdf"></i> PDF</button>
            <button class="btn btn-secondary"><i class="fas fa-file-csv"></i> CSV</button>
        </div>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr);">
    <div class="card stat-card">
        <i class="fas fa-user-plus" style="font-size: 1.5rem; color: var(--primary); margin-bottom: 12px;"></i>
        <h3>Total Beneficiaries</h3>
        <div class="value">1,248,302</div>
    </div>
    <div class="card stat-card">
        <i class="fas fa-id-card-clip" style="font-size: 1.5rem; color: var(--accent); margin-bottom: 12px;"></i>
        <h3>Pending Verification</h3>
        <div class="value">42,109</div>
    </div>
    <div class="card stat-card">
        <i class="fas fa-circle-check" style="font-size: 1.5rem; color: var(--success); margin-bottom: 12px;"></i>
        <h3>KYC Completed</h3>
        <div class="value">98.2%</div>
    </div>
    <div class="card stat-card">
        <i class="fas fa-money-bill-transfer" style="font-size: 1.5rem; color: var(--secondary); margin-bottom: 12px;"></i>
        <h3>Current Disbursal</h3>
        <div class="value">₹14.2 Cr</div>
    </div>
</div>

<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
        <div class="search-container" style="flex: 1; min-width: 300px;">
            <i class="fas fa-search"></i>
            <input type="text" id="beneficiarySearch" placeholder="Search by Name, Aadhaar, or OneID..." onkeyup="filterTable()">
        </div>
        <select id="schemeFilter" onchange="filterTable()" style="padding: 10px; border: 1px solid var(--border); border-radius: 8px; outline: none; background: white;">
            <option value="All">All Schemes</option>
            <option value="Old Age Pension">Old Age Pension</option>
            <option value="Disability Support">Disability Support</option>
            <option value="Widow Pension">Widow Pension</option>
        </select>
        <select id="statusFilter" onchange="filterTable()" style="padding: 10px; border: 1px solid var(--border); border-radius: 8px; outline: none; background: white;">
            <option value="All">All Status</option>
            <option value="Verified">Verified</option>
            <option value="Pending">Pending</option>
            <option value="Flagged">Flagged</option>
        </select>
    </div>
</div>

<div class="card" style="padding: 0;">
    <table id="beneficiaryTable" style="margin-top: 0;">
        <thead style="background: #f8fafc;">
            <tr>
                <th style="padding-left: 24px;">Citizen Name</th>
                <th>OneID / Aadhaar</th>
                <th>Scheme Type</th>
                <th>KYC Status</th>
                <th style="padding-right: 24px;">Verification</th>
            </tr>
        </thead>
        <tbody>
            @php
                $beneficiaries = [
                    ['Anjali Sharma', 'Mumbai, MH', 'ID-8829-1022', 'XXXX XXXX 4412', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Rajesh Kumar', 'Bengaluru, KA', 'ID-2234-9901', 'XXXX XXXX 8820', 'Disability Support', 'Bio Mismatch', 'Pending', 'warning'],
                    ['Vikram Singh', 'Jaipur, RJ', 'ID-1092-3345', 'XXXX XXXX 1122', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Priya Patel', 'Ahmedabad, GJ', 'ID-5566-7788', 'XXXX XXXX 3344', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Amit Das', 'Kolkata, WB', 'ID-9900-1122', 'XXXX XXXX 5566', 'Old Age Pension', 'Pending', 'Pending', 'warning'],
                    ['Sita Devi', 'Patna, BR', 'ID-3344-5566', 'XXXX XXXX 7788', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Arjun Rao', 'Hyderabad, TS', 'ID-7788-9900', 'XXXX XXXX 9900', 'Disability Support', 'Flagged', 'Flagged', 'danger'],
                    ['Meena Iyer', 'Chennai, TN', 'ID-1122-3344', 'XXXX XXXX 1111', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Sunil Verma', 'Lucknow, UP', 'ID-4455-6677', 'XXXX XXXX 2222', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Kavita Rani', 'Chandigarh, PB', 'ID-6677-8899', 'XXXX XXXX 3333', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Rahul Gupta', 'Delhi, DL', 'ID-8899-0011', 'XXXX XXXX 4444', 'Disability Support', 'Complete', 'Verified', 'success'],
                    ['Pooja Shah', 'Pune, MH', 'ID-0011-2233', 'XXXX XXXX 5555', 'Old Age Pension', 'Bio Mismatch', 'Pending', 'warning'],
                    ['Manoj Tiwari', 'Ranchi, JH', 'ID-2233-4455', 'XXXX XXXX 6666', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Sanjay Malo', 'Guwahati, AS', 'ID-4455-1122', 'XXXX XXXX 7777', 'Disability Support', 'Complete', 'Verified', 'success'],
                    ['Lakshmi N.', 'Kochi, KL', 'ID-6677-2233', 'XXXX XXXX 8888', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Deepak Jha', 'Indore, MP', 'ID-8899-3344', 'XXXX XXXX 9999', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Suresh Pal', 'Bhopal, MP', 'ID-1122-5566', 'XXXX XXXX 0000', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Anita Baxi', 'Surat, GJ', 'ID-3344-7788', 'XXXX XXXX 1234', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Gopal Das', 'Bhubaneswar, OD', 'ID-5566-9900', 'XXXX XXXX 5678', 'Old Age Pension', 'Pending', 'Pending', 'warning'],
                    ['Radhika M.', 'Mysuru, KA', 'ID-7788-1122', 'XXXX XXXX 9012', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Harish K.', 'Nagpur, MH', 'ID-9900-3344', 'XXXX XXXX 3456', 'Disability Support', 'Complete', 'Verified', 'success'],
                    ['Neeta Sen', 'Shimla, HP', 'ID-1122-7788', 'XXXX XXXX 7890', 'Widow Pension', 'Complete', 'Verified', 'success'],
                    ['Vijay Negi', 'Dehradun, UK', 'ID-3344-9900', 'XXXX XXXX 2345', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Alok Mishra', 'Varanasi, UP', 'ID-5566-1122', 'XXXX XXXX 6789', 'Old Age Pension', 'Complete', 'Verified', 'success'],
                    ['Sneha Patil', 'Nashik, MH', 'ID-7788-3344', 'XXXX XXXX 0123', 'Widow Pension', 'Complete', 'Verified', 'success'],
                ];
            @endphp

            @foreach($beneficiaries as $b)
            <tr class="beneficiary-row">
                <td style="padding-left: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($b[0]) }}&background=random" style="width: 40px; height: 40px; border-radius: 50%;">
                        <div>
                            <div class="citizen-name" style="font-weight: 600;">{{ $b[0] }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-light)">{{ $b[1] }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="one-id" style="font-weight: 600; color: var(--primary);">{{ $b[2] }}</div>
                    <div class="aadhaar" style="font-size: 0.75rem; color: var(--text-light)">{{ $b[3] }}</div>
                </td>
                <td>
                    <span class="scheme-label" style="display: inline-block; padding: 4px 8px; background: #eef2ff; color: #4338ca; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">{{ $b[4] }}</span>
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 6px; color: {{ $b[7] == 'success' ? 'var(--success)' : ($b[7] == 'warning' ? '#9a3412' : 'var(--danger)') }}; font-weight: 600; font-size: 0.875rem;">
                        <i class="fas {{ $b[7] == 'success' ? 'fa-circle-check' : ($b[7] == 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-xmark') }}"></i> {{ $b[5] }}
                    </div>
                </td>
                <td style="padding-right: 24px;">
                    <span class="badge badge-{{ $b[7] }} status-badge" style="padding: 6px 16px;">{{ $b[6] }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border);">
        <div style="font-size: 0.875rem; color: var(--text-light);">Showing 1-{{ count($beneficiaries) }} of 1,248,302 results</div>
        <div style="display: flex; gap: 8px;">
            <button class="btn btn-secondary" style="padding: 6px 12px;"><i class="fas fa-chevron-left"></i></button>
            <button class="btn btn-primary" style="padding: 6px 12px;">1</button>
            <button class="btn btn-secondary" style="padding: 6px 12px;">2</button>
            <button class="btn btn-secondary" style="padding: 6px 12px;">3</button>
            <button class="btn btn-secondary" style="padding: 6px 12px;"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function filterTable() {
        const searchText = document.getElementById('beneficiarySearch').value.toLowerCase();
        const schemeValue = document.getElementById('schemeFilter').value;
        const statusValue = document.getElementById('statusFilter').value;
        
        const rows = document.querySelectorAll('.beneficiary-row');

        rows.forEach(row => {
            const name = row.querySelector('.citizen-name').innerText.toLowerCase();
            const id = row.querySelector('.one-id').innerText.toLowerCase();
            const aadhaar = row.querySelector('.aadhaar').innerText.toLowerCase();
            const scheme = row.querySelector('.scheme-label').innerText;
            const status = row.querySelector('.status-badge').innerText;

            const matchesSearch = name.includes(searchText) || id.includes(searchText) || aadhaar.includes(searchText);
            const matchesScheme = schemeValue === 'All' || scheme === schemeValue;
            const matchesStatus = statusValue === 'All' || status === statusValue;

            if (matchesSearch && matchesScheme && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const topSearch = document.querySelector('.top-bar input');
        if (topSearch) {
            topSearch.addEventListener('keyup', (e) => {
                const localSearch = document.getElementById('beneficiarySearch');
                if (localSearch) {
                    localSearch.value = e.target.value;
                    filterTable();
                }
            });
        }
    });
</script>
@endsection
@endsection
