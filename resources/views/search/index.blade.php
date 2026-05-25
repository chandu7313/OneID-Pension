@extends('layouts.admin')

@section('content')
<div class="mb-4 text-center">
    <h2>Search Portal</h2>
    <p class="text-muted">Find citizens, pension schemes, and assignments.</p>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <form action="{{ route('search.index') }}" method="GET">
            <div class="input-group input-group-lg">
                <input type="text" name="q" class="form-control" placeholder="Search by name, aadhaar, scheme code, enrollment..." value="{{ $query ?? '' }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

@if(isset($query) && $query)
    <div class="mb-3">
        <h4>Search Results for "{{ $query }}"</h4>
        <p class="text-muted">Found {{ $totalResults }} results.</p>
    </div>

    <div class="row">
        <!-- Citizens Results -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Citizens ({{ $results['citizens']->count() }})</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($results['citizens'] as $citizen)
                        <li class="list-group-item">
                            <strong>{{ $citizen->full_name }}</strong><br>
                            <small class="text-muted">Aadhaar: {{ $citizen->aadhaar_number }}</small><br>
                            <a href="{{ route('citizens.edit', $citizen) }}" class="btn btn-sm btn-link p-0 mt-1">View Details</a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center py-4">No citizens found.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Schemes Results -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Pension Schemes ({{ $results['schemes']->count() }})</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($results['schemes'] as $scheme)
                        <li class="list-group-item">
                            <strong>{{ $scheme->scheme_name }}</strong><br>
                            <small class="text-muted">Code: {{ $scheme->scheme_code }}</small><br>
                            <a href="{{ route('pension-schemes.edit', $scheme) }}" class="btn btn-sm btn-link p-0 mt-1">View Details</a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center py-4">No schemes found.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Assignments Results -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Assignments ({{ $results['assignments']->count() }})</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($results['assignments'] as $assignment)
                        <li class="list-group-item">
                            <strong>{{ $assignment->enrollment_number }}</strong><br>
                            <small class="text-muted">Citizen: {{ $assignment->citizen->full_name ?? 'N/A' }}</small><br>
                            <a href="{{ route('citizen-pensions.edit', $assignment) }}" class="btn btn-sm btn-link p-0 mt-1">View Details</a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center py-4">No assignments found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@elseif(isset($query))
    <div class="alert alert-info text-center">
        No results found for "{{ $query }}". Please try a different search term.
    </div>
@endif
@endsection
