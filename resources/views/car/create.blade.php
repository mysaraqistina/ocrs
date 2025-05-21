@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Car</h2>
    <form action="{{ isset($car) ? route('admin.cars.update', $car->id) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($car))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select name="branch_id" id="branch_id" class="form-control" required>
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
            <input type="text" class="form-control" name="brand" id="brand" value="{{ isset($car) ? $car->brand : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" name="model" id="model" value="{{ isset($car) ? $car->model : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="SUV" {{ isset($car) && $car->type == 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="Sedan" {{ isset($car) && $car->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                <option value="Hatchback" {{ isset($car) && $car->type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="transmission" class="form-label">Transmission</label>
            <select name="transmission" id="transmission" class="form-control" required>
                <option value="">Select Transmission</option>
                <option value="Automatic" {{ isset($car) && $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                <option value="Manual" {{ isset($car) && $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available" {{ isset($car) && $car->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ isset($car) && $car->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Car Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            @if(isset($car) && $car->image)
                <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection