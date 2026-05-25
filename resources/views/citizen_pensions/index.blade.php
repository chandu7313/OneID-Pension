@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pension Assignments</h2>
    <a href="{{ route('citizen-pensions.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Assign Scheme to Citizen
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Enrollment No</th>
                        <th>Citizen Name</th>
                        <th>Scheme</th>
                        <th>Start Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->enrollment_number }}</td>
                        <td>{{ $assignment->citizen->full_name ?? 'N/A' }}</td>
                        <td>{{ $assignment->pensionScheme->scheme_name ?? 'N/A' }}</td>
                        <td>{{ $assignment->start_date }}</td>
                        <td>${{ number_format($assignment->benefit_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $assignment->pension_status == 'Active' ? 'success' : ($assignment->pension_status == 'Pending' ? 'warning' : 'secondary') }}">
                                {{ $assignment->pension_status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('citizen-pensions.edit', $assignment) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('citizen-pensions.destroy', $assignment) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this assignment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No pension assignments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $assignments->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
