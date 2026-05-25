@extends('layouts.app')

@section('title', 'Fraud Detection')

@section('content')
@php
    $reviews = [
        [
            'id' => 1,
            'name' => 'Rahul V. Deshmukh',
            'score' => '98.4%',
            'match_type' => 'High Risk',
            'time' => '2h ago',
            'record_a' => ['Rahul V. Deshmukh', '12-05-1965', 'ABCDE1234F', 'Sector 4, Vashi, Mumbai'],
            'record_b' => ['Rahul Vinayak Deshmukh', '12-05-1964', 'ABCDE1234F', 'Flat 402, Sector 4, Vashi'],
            'reason' => 'Exact PAN match with minor DOB discrepancy (1 year). Address is a contextual match (Building/Flat level detail added).',
            'metrics' => ['94% Match', 'Conflict', 'Exact Match', 'Contextual']
        ],
        [
            'id' => 2,
            'name' => 'Sita Ramakrishnan',
            'score' => '76.2%',
            'match_type' => 'Medium Risk',
            'time' => '5h ago',
            'record_a' => ['Sita Ramakrishnan', '01-01-1970', 'FGHIJ5678K', 'Adyar, Chennai'],
            'record_b' => ['S. Ramakrishnan', '01-01-1970', 'FGHIJ5678K', 'Besant Nagar, Chennai'],
            'reason' => 'Biometric signature overlap detected. PAN matches exactly. Address has shifted within the same city.',
            'metrics' => ['Partial Match', 'Exact Match', 'Exact Match', 'Shift Detected']
        ],
        [
            'id' => 3,
            'name' => 'Amitabh Bachchan (Daughter)',
            'score' => '45.1%',
            'match_type' => 'Low Risk',
            'time' => '1d ago',
            'record_a' => ['Shweta Nanda', '17-03-1974', 'LMNOP9012Q', 'Juhu, Mumbai'],
            'record_b' => ['Shweta Bachchan', '17-03-1974', 'LMNOP9012Q', 'Pratiksha, Juhu'],
            'reason' => 'Maiden name vs Married name detected. All other KYC attributes including PAN and DOB are consistent.',
            'metrics' => ['Name Change', 'Exact Match', 'Exact Match', 'Verified Locality']
        ],
        [
            'id' => 4,
            'name' => 'Vikram Aditya Singh',
            'score' => '92.0%',
            'match_type' => 'High Risk',
            'time' => '2d ago',
            'record_a' => ['Vikram A. Singh', '10-10-1960', 'XYZ1234567', 'Civil Lines, Jaipur'],
            'record_b' => ['Vikram Aditya Singh', '10-10-1960', 'XYZ7654321', 'Civil Lines, Jaipur'],
            'reason' => 'Duplicate Aadhaar detected with different PAN numbers. Possible identity forgery or multiple enrollments.',
            'metrics' => ['Full Match', 'Exact Match', 'Conflict (PAN)', 'Exact Match']
        ],
        [
            'id' => 5,
            'name' => 'Priya S. Patel',
            'score' => '15.5%',
            'match_type' => 'Low Risk',
            'time' => '3d ago',
            'record_a' => ['Priya Patel', '22-11-1985', 'PATELP123', 'Satellite, Ahmedabad'],
            'record_b' => ['Priya S. Patel', '22-11-1985', 'PATELP123', 'Satellite, Ahmedabad'],
            'reason' => 'Routine update of middle initial. No discrepancies found.',
            'metrics' => ['Matched', 'Exact', 'Exact', 'Exact']
        ],
        [
            'id' => 6,
            'name' => 'Mohammed Khalid',
            'score' => '88.9%',
            'match_type' => 'High Risk',
            'time' => '4d ago',
            'record_a' => ['Md. Khalid', '15-08-1955', 'KHALID99', 'Old City, Hyderabad'],
            'record_b' => ['Mohammad Khalid', '15-08-1955', 'KHALID99', 'Secunderabad, TS'],
            'reason' => 'Multiple pension applications detected across different districts with the same PRAN number.',
            'metrics' => ['Varied', 'Exact', 'Exact', 'Location Conflict']
        ]
    ];
@endphp

<div class="header" style="margin-bottom: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 700; color: var(--secondary);">Fraud Detection Center</h1>
            <p style="color: var(--text-light);">AI-powered analysis of potential duplicate identities and benefit overlap.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="btn btn-primary" onclick="showNotification('Scanning entire database... 0% completed')"><i class="fas fa-magnifying-glass-chart"></i> Run Batch Scan</button>
            <button class="btn btn-secondary">Refresh Analysis</button>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
    <!-- Pending Reviews Sidebar -->
    <div class="card" style="padding: 16px; height: calc(100vh - 250px); overflow-y: auto;">
        <h3 style="font-size: 0.875rem; color: var(--text-light); text-transform: uppercase; margin-bottom: 16px;">Pending Reviews ({{ count($reviews) }})</h3>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($reviews as $r)
            <div class="review-item" onclick="loadReview({{ json_encode($r) }}, this)" style="padding: 16px; border: 1px solid var(--border); border-radius: 12px; cursor: pointer; transition: 0.2s; {{ $loop->first ? 'border: 2px solid var(--primary); background: var(--primary-light);' : '' }}">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                    <span class="badge {{ floatval($r['score']) > 80 ? 'badge-danger' : (floatval($r['score']) > 50 ? 'badge-warning' : 'badge-success') }}">{{ $r['score'] }} Match</span>
                    <span style="font-size: 0.75rem; color: var(--text-light)">{{ $r['time'] }}</span>
                </div>
                <div style="font-weight: 700; font-size: 1rem;">{{ $r['name'] }}</div>
                <div style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 8px;">Risk: {{ $r['match_type'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Analysis Workspace -->
    <div class="card" id="analysisWorkspace">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 700;" id="ws-name">{{ $reviews[0]['name'] }}</h2>
                <p style="font-size: 0.875rem; color: var(--text-light)">Comparing Record A (Legacy) vs Record B (New Application)</p>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 1.5rem; font-weight: 800; color: var(--danger);" id="ws-score">{{ $reviews[0]['score'] }}</div>
                <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-light); text-transform: uppercase;">Risk Score</div>
            </div>
        </div>

        <table id="ws-table">
            <thead>
                <tr>
                    <th>Field Attribute</th>
                    <th>Record A (Master)</th>
                    <th>Record B (Candidate)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="font-weight: 600;">Full Name</td><td id="ws-a-0">{{ $reviews[0]['record_a'][0] }}</td><td id="ws-b-0">{{ $reviews[0]['record_b'][0] }}</td><td id="ws-m-0">{{ $reviews[0]['metrics'][0] }}</td></tr>
                <tr><td style="font-weight: 600;">Date of Birth</td><td id="ws-a-1">{{ $reviews[0]['record_a'][1] }}</td><td id="ws-b-1">{{ $reviews[0]['record_b'][1] }}</td><td id="ws-m-1">{{ $reviews[0]['metrics'][1] }}</td></tr>
                <tr><td style="font-weight: 600;">PAN Number</td><td id="ws-a-2">{{ $reviews[0]['record_a'][2] }}</td><td id="ws-b-2">{{ $reviews[0]['record_b'][2] }}</td><td id="ws-m-2">{{ $reviews[0]['metrics'][2] }}</td></tr>
                <tr><td style="font-weight: 600;">Permanent Address</td><td id="ws-a-3">{{ $reviews[0]['record_a'][3] }}</td><td id="ws-b-3">{{ $reviews[0]['record_b'][3] }}</td><td id="ws-m-3">{{ $reviews[0]['metrics'][3] }}</td></tr>
            </tbody>
        </table>

        <div style="margin-top: 32px; padding: 24px; background: #f8fafc; border-radius: 12px; border-left: 4px solid var(--primary);">
            <h4 style="margin-bottom: 12px; display: flex; align-items: center; gap: 8px;"><i class="fas fa-microchip" style="color: var(--primary)"></i> AI Reasoning Engine</h4>
            <p style="font-size: 0.875rem; color: var(--text-light); line-height: 1.6;" id="ws-reason">
                "{{ $reviews[0]['reason'] }}"
            </p>
        </div>

        <div style="margin-top: 32px; display: flex; gap: 16px; justify-content: flex-end;">
            <button class="btn" style="background: #fee2e2; color: #991b1b; border: 1px solid #fecaca;" onclick="showNotification('Application Rejected', 'error')">Reject Case</button>
            <button class="btn btn-secondary">Investigate</button>
            <button class="btn btn-primary" onclick="showNotification('Records Merged Successfully')">Approve & Merge</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function loadReview(data, el) {
        // Update sidebar UI
        document.querySelectorAll('.review-item').forEach(item => {
            item.style.border = '1px solid var(--border)';
            item.style.background = 'white';
        });
        el.style.border = '2px solid var(--primary)';
        el.style.background = 'var(--primary-light)';

        // Update workspace
        document.getElementById('ws-name').innerText = data.name;
        document.getElementById('ws-score').innerText = data.score;
        document.getElementById('ws-reason').innerText = '"' + data.reason + '"';

        // Update table
        for (let i = 0; i < 4; i++) {
            document.getElementById('ws-a-' + i).innerText = data.record_a[i];
            document.getElementById('ws-b-' + i).innerText = data.record_b[i];
            
            const metric = data.metrics[i];
            let statusHtml = '';
            if (metric.toLowerCase().includes('exact')) {
                statusHtml = '<span style="color: var(--success); font-weight: 700;"><i class="fas fa-circle-check"></i> ' + metric + '</span>';
            } else if (metric.toLowerCase().includes('conflict')) {
                statusHtml = '<span style="color: var(--danger); font-weight: 700;"><i class="fas fa-circle-exclamation"></i> ' + metric + '</span>';
            } else {
                statusHtml = '<span style="color: var(--primary); font-weight: 700;"><i class="fas fa-circle-info"></i> ' + metric + '</span>';
            }
            document.getElementById('ws-m-' + i).innerHTML = statusHtml;
        }

        // Apply score color
        const score = parseFloat(data.score);
        const scoreEl = document.getElementById('ws-score');
        if (score > 80) scoreEl.style.color = 'var(--danger)';
        else if (score > 50) scoreEl.style.color = 'var(--warning)';
        else scoreEl.style.color = 'var(--success)';
    }
</script>
@endsection
