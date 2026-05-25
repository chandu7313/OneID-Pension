@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Citizens</h5>
                    <h2 class="display-4">{{ $totalCitizens }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Active Schemes</h5>
                    <h2 class="display-4">{{ $activeSchemes }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Assignments</h5>
                    <h2 class="display-4">{{ $totalAssignments }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Pending Assignments</h5>
                    <h2 class="display-4">{{ $pendingAssignments }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Citizens</h5>
                    <a href="{{ route('citizens.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Aadhaar</th>
                                    <th>Mobile</th>
                                    <th>State</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentCitizens as $citizen)
                                <tr>
                                    <td>{{ $citizen->full_name }}</td>
                                    <td>{{ $citizen->aadhaar_number }}</td>
                                    <td>{{ $citizen->mobile_number }}</td>
                                    <td>{{ $citizen->state }}</td>
                                    <td><span class="badge bg-{{ $citizen->pension_status == 'Active' ? 'success' : ($citizen->pension_status == 'Pending' ? 'warning' : 'secondary') }}">{{ $citizen->pension_status }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No citizens registered yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
