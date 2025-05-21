@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">All Bookings</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">Back to Admin Dashboard</a>

    <div class="card">
        <div class="card-header bg-primary text-white">Bookings List</div>
        <div class="card-body">
            @if($bookings->count())
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Branch</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                                <td>{{ $booking->car->brand ?? 'N/A' }} {{ $booking->car->model ?? '' }}</td>
                                <td>{{ $booking->car->branch->name ?? 'N/A' }}</td>
                                <td>{{ date('d M Y', strtotime($booking->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($booking->end_date)) }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($booking->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this booking?')">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this booking?')">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No bookings found.</p>
            @endif
        </div>
    </div>
</div>
@endsection