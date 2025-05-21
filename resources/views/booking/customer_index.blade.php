@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">My Bookings</h2>
        <a href="{{ route('home', ['customer_id' => $customer->id]) }}"
           class="btn btn-warning btn-lg fw-bold rounded-pill shadow px-4 py-2"
           style="font-size: 1.2rem;">
            <i class="bi bi-arrow-left-circle me-2"></i>
            Back to Homepage
        </a>
    </div>

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
