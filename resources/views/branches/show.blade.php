@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-4 mb-4">
        <div class="card-body">
            <h2 class="fw-bold mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Branch: {{ $branch->name }}</h2>
            <p class="mb-4 text-muted"><i class="bi bi-geo text-secondary me-1"></i>Location: {{ $branch->location }}</p>

            <h4 class="fw-bold mb-3"><i class="bi bi-car-front-fill text-warning me-2"></i>Cars Available in this Branch</h4>

            @if($cars->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle rounded-3 overflow-hidden">
                        <thead class="table-dark">
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Transmission</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->type }}</td>
                                    <td>{{ $car->transmission }}</td>
                                    <td>
                                        @if(strtolower($car->status) == 'available')
                                            <span class="badge bg-success px-3 py-2">Available</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2">Not Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center mb-0">No cars found for this branch.</div>
            @endif

            <a href="{{ route('admin.index') }}" class="btn btn-warning fw-bold rounded-pill shadow mt-4 px-4 py-2">
                <i class="bi bi-arrow-left-circle me-2"></i>Back to Branch List
            </a>
        </div>
    </div>
</div>
@endsection
