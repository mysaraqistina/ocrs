@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <h4 class="mb-0">Welcome, {{ $customer->name ?? 'Customer' }}!</h4>
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
                        Car: {{ $latestBooking->car->brand ?? 'N/A' }} {{ $latestBooking->car->model ?? 'N/A' }}<br>
                        Status: {{ $latestBooking->status == 'pending' ? 'Pending' : ($latestBooking->status == 'approved' ? 'Confirmed' : 'Cancelled') }}<br>
                    @else
                        Start Date: N/A<br>
                        End Date: N/A<br>
                        Car: N/A<br>
                        Status: N/A<br>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-4">Browse Available Cars</h5>
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
                    <img src="{{ $car->image ? asset('images/' . $car->image) : asset('images/default-car.png') }}"
                         class="card-img-top"
                         alt="{{ $car->brand }} {{ $car->model }}"
                         style="width: 100%; height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        @if($errors->has('start_date'))
                            <div class="alert alert-danger">
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
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
                            <button type="submit" class="btn btn-warning w-100 fw-bold">
                                <i class="bi bi-calendar-plus"></i> Book Now
                            </button>
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
