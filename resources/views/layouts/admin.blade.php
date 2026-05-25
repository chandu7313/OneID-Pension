<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneCitizen Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar a { color: #fff; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover { background-color: #495057; }
        .sidebar a.active { background-color: #0d6efd; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3 text-white" style="width: 250px;">
            <h4 class="mb-4">OneCitizen</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('citizens.index') }}" class="nav-link {{ request()->is('citizens*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Citizens
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pension-schemes.index') }}" class="nav-link {{ request()->is('pension-schemes*') ? 'active' : '' }}">
                        <i class="bi bi-card-list me-2"></i> Pension Schemes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('citizen-pensions.index') }}" class="nav-link {{ request()->is('citizen-pensions*') ? 'active' : '' }}">
                        <i class="bi bi-person-check me-2"></i> Assignments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('search.index') }}" class="nav-link {{ request()->routeIs('search.index') ? 'active' : '' }}">
                        <i class="bi bi-search me-2"></i> Search
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
