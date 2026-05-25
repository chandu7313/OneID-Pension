<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | OneID Pension System</title>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #003399;
            --primary-light: #e6edff;
            --secondary: #001a4d;
            --accent: #ff6600;
            --bg: #f8fafc;
            --text: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg); color: var(--text); line-height: 1.5; }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--border);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 24px;
            z-index: 100;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .nav-menu { list-style: none; flex-grow: 1; }
        .nav-item { margin-bottom: 8px; }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-light);
            border-radius: 8px;
            transition: all 0.2s;
            font-weight: 500;
        }
        .nav-link:hover, .nav-link.active {
            background: var(--primary-light);
            color: var(--primary);
        }
        .nav-link i { font-size: 1.1rem; }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 32px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .search-container {
            position: relative;
            width: 400px;
        }
        .search-container input {
            width: 100%;
            padding: 10px 16px 10px 44px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
        }
        .search-container i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Common Components */
        .card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card h3 { color: var(--text-light); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .stat-card .value { font-size: 1.75rem; font-weight: 700; color: var(--primary); }
        .stat-card .trend { font-size: 0.875rem; margin-top: 8px; }
        .trend.up { color: var(--success); }
        .trend.down { color: var(--danger); }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: opacity 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-primary { background: var(--primary); color: var(--white); }
        .btn-secondary { background: var(--white); color: var(--text); border: 1px solid var(--border); }
        .btn:hover { opacity: 0.9; }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-danger { background: #fee2e2; color: #b91c1c; }

        th { text-align: left; padding: 16px; border-bottom: 2px solid var(--border); color: var(--text-light); font-weight: 600; font-size: 0.875rem; }
        td { padding: 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }

        /* Indian Govt Theme Accents */
        .govt-tricolor {
            height: 4px;
            width: 100%;
            background: linear-gradient(to right, #FF9933 33.3%, #FFFFFF 33.3%, #FFFFFF 66.6%, #128807 66.6%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
    </style>
    <script>
        function exportToCSV(tableId, filename) {
            let csv = [];
            let rows = document.querySelectorAll("#" + tableId + " tr");
            
            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (let j = 0; j < cols.length; j++) 
                    row.push('"' + cols[j].innerText.trim() + '"');
                
                csv.push(row.join(","));        
            }

            let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
            let downloadLink = document.createElement("a");
            downloadLink.download = filename + ".csv";
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }

        function showNotification(message, type = 'success') {
            const toast = document.createElement('div');
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.right = '20px';
            toast.style.padding = '12px 24px';
            toast.style.borderRadius = '8px';
            toast.style.backgroundColor = type === 'success' ? '#10b981' : '#ef4444';
            toast.style.color = 'white';
            toast.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
            toast.style.zIndex = '9999';
            toast.innerText = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
    @yield('styles')
</head>
<body style="padding-top: 4px;">
    <div class="govt-tricolor"></div>
    @if(!View::hasSection('no-layout'))
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/pension_logo.png') }}" style="height: 32px; width: auto;" alt="Pension Logo">
            <span>OneID Pension</span>
        </div>
        <ul class="nav-menu">
            @if(Request::is('admin*'))
                <li class="nav-item">
                    <a href="{{ url('/admin') }}" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/beneficiaries') }}" class="nav-link {{ Request::is('admin/beneficiaries') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Beneficiaries</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/fraud') }}" class="nav-link {{ Request::is('admin/fraud') ? 'active' : '' }}">
                        <i class="fas fa-shield-halved"></i>
                        <span>Fraud Detection</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/disbursements') }}" class="nav-link {{ Request::is('admin/disbursements') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Disbursements</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/settings') }}" class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}">
                        <i class="fas fa-gear"></i>
                        <span>System Settings</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ url('/citizen/dashboard') }}" class="nav-link {{ Request::is('citizen/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-house"></i>
                        <span>My Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/citizen/payments') }}" class="nav-link {{ Request::is('citizen/payments') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice"></i>
                        <span>My Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/citizen/certificates') }}" class="nav-link {{ Request::is('citizen/certificates') ? 'active' : '' }}">
                        <i class="fas fa-file-shield"></i>
                        <span>Certificates</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/citizen/grievances') }}" class="nav-link {{ Request::is('citizen/grievances') ? 'active' : '' }}">
                        <i class="fas fa-comments"></i>
                        <span>Grievances</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="nav-footer">
            <a href="{{ url('/logout') }}" class="nav-link" style="color: var(--danger)">
                <i class="fas fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
    @endif

    <div class="{{ View::hasSection('no-layout') ? '' : 'main-content' }}">
        @if(!View::hasSection('no-layout'))
        <div class="top-bar">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search by OneID, Aadhaar, or Name...">
            </div>
            <a href="{{ url('/profile') }}" class="user-profile" style="text-decoration: none; color: inherit;">
                <div style="text-align: right">
                    <div style="font-weight: 600">{{ Request::is('admin*') ? 'A. Sharma' : 'Rajesh Kumar' }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-light)">{{ Request::is('admin*') ? 'Lead Auditor' : 'Verified Citizen' }}</div>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Request::is('admin*') ? 'A+Sharma' : 'Rajesh+Kumar' }}&background=003399&color=fff" alt="Profile">
            </a>
        </div>
        @endif

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
