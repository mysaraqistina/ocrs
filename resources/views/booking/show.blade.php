@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Booking Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Car: {{ $booking->car->brand ?? 'N/A' }} {{ $booking->car->model ?? '' }}</h5>
            <p class="card-text">
                <strong>Customer:</strong> {{ $booking->customer->name ?? 'N/A' }}<br>
                <strong>Branch:</strong> {{ $booking->car->branch->name ?? 'N/A' }}<br>
                <strong>Start Date:</strong> {{ date('d M Y', strtotime($booking->start_date)) }}<br>
                <strong>End Date:</strong> {{ date('d M Y', strtotime($booking->end_date)) }}<br>
                <strong>Status:</strong>
                @if($booking->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($booking->status == 'confirmed')
                    <span class="badge bg-success">Confirmed</span>
                @elseif($booking->status == 'cancelled')
                    <span class="badge bg-danger">Cancelled</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                @endif
            </p>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">Back to Bookings</a>
        </div>
    </div>
</div>
@endsection