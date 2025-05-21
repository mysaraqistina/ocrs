@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">My Bookings</h2>
    <a href="{{ route('home', ['customer_id' => $customer->id]) }}" class="btn btn-secondary mb-3">Back to Homepage</a>

    {{-- Current Booking --}}
    @if($currentBooking)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Current Booking</div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="{{ $currentBooking->car->image ? asset('images/' . $currentBooking->car->image) : asset('images/default-car.png') }}" class="img-fluid rounded" alt="Car">
                    </div>
                    <div class="col-md-10">
                        <h5>{{ $currentBooking->car->brand }} {{ $currentBooking->car->model }}</h5>
                        <p>
                            <strong>From:</strong> {{ date('d M Y', strtotime($currentBooking->start_date)) }}<br>
                            <strong>To:</strong> {{ date('d M Y', strtotime($currentBooking->end_date)) }}<br>
                            <strong>Status:</strong>
                            @if($currentBooking->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($currentBooking->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($currentBooking->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($currentBooking->status) }}</span>
                            @endif
                        </p>
                        @if($currentBooking->status == 'pending')
                            <form action="{{ route('bookings.destroy', $currentBooking->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">No current booking.</div>
    @endif

    {{-- Upcoming Bookings --}}
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Upcoming Bookings</div>
        <div class="card-body">
            @if($upcomingBookings->count())
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($upcomingBookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->car->brand ?? 'N/A' }} {{ $booking->car->model ?? '' }}</td>
                                <td>{{ date('d M Y', strtotime($booking->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($booking->end_date)) }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No upcoming bookings.</p>
            @endif
        </div>
    </div>

    {{-- Past Bookings --}}
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Past Bookings</div>
        <div class="card-body">
            @if($pastBookings->count())
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pastBookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->car->brand ?? 'N/A' }} {{ $booking->car->model ?? '' }}</td>
                                <td>{{ date('d M Y', strtotime($booking->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($booking->end_date)) }}</td>
                                <td>
                                    @if($booking->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No past bookings.</p>
            @endif
        </div>
    </div>
</div>
@endsection
