@extends('layouts.dashboard')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Car</h2>
    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand', $car->brand) }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $car->model) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $car->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="transmission" class="form-label">Transmission</label>
            <select name="transmission" id="transmission" class="form-control" required>
                <option value="Automatic" {{ old('transmission', $car->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                <option value="Manual" {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select name="branch_id" id="branch_id" class="form-control" required>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id', $car->branch_id) == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ old('status', $car->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Car Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            @if($car->image)
                <img src="{{ asset('images/' . $car->image) }}" alt="Car Image" width="120" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-warning fw-bold rounded-pill shadow px-4 me-2">
            <i class="bi bi-save me-1"></i> Update Car
        </button>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill shadow px-4">
            <i class="bi bi-x-circle me-1"></i> Cancel
        </a>
    </form>
</div>
@endsection