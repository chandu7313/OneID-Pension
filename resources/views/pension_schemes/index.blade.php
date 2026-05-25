@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pension Schemes</h2>
    <a href="{{ route('pension-schemes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Create New Scheme
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Benefit Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schemes as $scheme)
                    <tr>
                        <td>{{ $scheme->scheme_code }}</td>
                        <td>{{ $scheme->scheme_name }}</td>
                        <td>{{ $scheme->scheme_type }}</td>
                        <td>${{ number_format($scheme->benefit_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $scheme->status == 'Active' ? 'success' : ($scheme->status == 'Inactive' ? 'secondary' : 'warning') }}">
                                {{ $scheme->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('pension-schemes.edit', $scheme) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('pension-schemes.destroy', $scheme) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this scheme?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No pension schemes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $schemes->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
