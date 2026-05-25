@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Citizens</h2>
    <a href="{{ route('citizens.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Register New Citizen
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Aadhaar</th>
                        <th>Mobile</th>
                        <th>State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citizens as $citizen)
                    <tr>
                        <td>{{ $citizen->id }}</td>
                        <td>{{ $citizen->full_name }}</td>
                        <td>{{ $citizen->aadhaar_number }}</td>
                        <td>{{ $citizen->mobile_number }}</td>
                        <td>{{ $citizen->state }}</td>
                        <td>
                            <a href="{{ route('citizens.edit', $citizen) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('citizens.destroy', $citizen) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this citizen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No citizens found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $citizens->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
