@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.index') }}"
           class="btn btn-warning btn-lg fw-bold rounded-pill shadow px-4 py-2"
           style="font-size: 1.1rem;">
            <i class="bi bi-arrow-left-circle me-2"></i>
            Back to Homepage
        </a>
        @if($admin->branch_id == 1 || $admin->branch_id == (isset($currentBranch) ? $currentBranch->id : $admin->branch_id))
            <a href="{{ route('admin.cars.create') }}"
               class="btn btn-success btn-lg fw-bold rounded-pill shadow px-4 py-2"
               style="font-size: 1.1rem;">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Car
            </a>
        @endif
    </div>

    <h2 class="mb-4">Manage Cars</h2>

    <!-- Car List Table -->
    <div class="card">
        <div class="card-header fw-bold">Car Inventory</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Transmission</th>
                        <th>Branch</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td>
                            <img src="{{ asset('images/' . $car->image) }}" alt="Car Image" width="80" height="50" style="object-fit:cover;">
                        </td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->type }}</td>
                        <td>{{ $car->transmission }}</td>
                        <td>{{ $car->branch->name }}</td>
                        <td>
                            @if($car->status == 'available')
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>
                        <td>
                            @if($admin->branch_id == 1 || $car->branch_id == $admin->branch_id)
                                <a href="{{ route('admin.cars.edit', $car->id) }}"
                                   class="btn btn-warning btn-sm rounded-pill fw-bold shadow-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this car?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-pill fw-bold shadow-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No cars found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
