@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <h2 class="mb-0">Welcome, {{ $customer->name ?? 'Customer' }}!</h2>
            <a href="{{ route('bookings.index', ['customer_id' => $customer->id]) }}"
               class="btn btn-primary ms-auto px-2 py-2 d-inline-flex align-items-center gap-2 shadow-sm rounded-pill"
               style="font-size: 1rem;">
                <i class="bi bi-journal-text" style="font-size: 1.2rem;"></i>
                View My Bookings
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <strong>Your Booking:</strong><br>
                    @if($latestBooking)
                        Start Date: {{ $latestBooking->start_date }}<br>
                        End Date: {{ $latestBooking->end_date }}<br>
                        Car Brand: {{ $latestBooking->car->brand ?? 'N/A' }}<br>
                        Car Type: {{ $latestBooking->car->type ?? 'N/A' }}<br>
                    @else
                        Start Date: N/A<br>
                        End Date: N/A<br>
                        Car Brand: N/A<br>
                        Car Type: N/A<br>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Browse Available Cars</h3>
    <form method="GET" action="{{ route('home') }}" class="row g-3 mb-4">
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <div class="col-md-3">
            <select name="branch_id" class="form-select">
                <option value="">All Branches</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="car_type" class="form-select">
                <option value="">All Types</option>
                <option value="Sedan" {{ request('car_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                <option value="SUV" {{ request('car_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="Hatchback" {{ request('car_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="transmission" class="form-select">
                <option value="">All Transmissions</option>
                <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="brand" class="form-select">
                <option value="">All Brands</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="row">
        @forelse($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $car->image ? asset('images/' . $car->image) : asset('images/default-car.png') }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                        <p class="card-text mb-2">
                            <span class="fw-bold">Branch:</span> {{ $car->branch->name }}<br>
                            <span class="fw-bold">Type:</span> {{ $car->type }}<br>
                            <span class="fw-bold">Transmission:</span> {{ $car->transmission }}<br>
                        </p>
                        <form method="POST" action="{{ route('bookings.store') }}" class="mt-auto">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="mb-2">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No cars found for the selected filters.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
