@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-4 mb-4">
        <div class="card-body">
            <h2 class="fw-bold mb-4">
                <i class="bi bi-plus-circle text-success me-2"></i>
                {{ isset($car) ? 'Edit Car' : 'Add New Car' }}
            </h2>
            <form action="{{ isset($car) ? route('admin.cars.update', $car->id) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($car))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="branch_id" class="form-label">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-select rounded-pill" required>
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ isset($car) && $car->branch_id == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control rounded-pill" name="brand" id="brand" value="{{ isset($car) ? $car->brand : '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control rounded-pill" name="model" id="model" value="{{ isset($car) ? $car->model : '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-select rounded-pill" required>
                        <option value="">Select Type</option>
                        <option value="SUV" {{ isset($car) && $car->type == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Sedan" {{ isset($car) && $car->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Hatchback" {{ isset($car) && $car->type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="transmission" class="form-label">Transmission</label>
                    <select name="transmission" id="transmission" class="form-select rounded-pill" required>
                        <option value="">Select Transmission</option>
                        <option value="Automatic" {{ isset($car) && $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="Manual" {{ isset($car) && $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select rounded-pill" required>
                        <option value="available" {{ isset($car) && $car->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ isset($car) && $car->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Car Image</label>
                    <input type="file" class="form-control rounded-pill" name="image" id="image" accept="image/*">
                    @if(isset($car) && $car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary rounded-pill">
                    <i class="bi bi-save me-1"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
</div>
@endsection