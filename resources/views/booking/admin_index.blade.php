@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">All Bookings</h2>
        <a href="{{ route('admin.index') }}"
           class="btn btn-warning btn-lg fw-bold rounded-pill shadow px-4 py-2"
           style="font-size: 1.1rem;">
            <i class="bi bi-arrow-left-circle me-2"></i>
            Back to Admin Dashboard
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white fw-bold fs-5">
            <i class="bi bi-list-ul me-2"></i>Bookings List
        </div>
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
                                            <button type="submit" class="btn btn-success btn-sm rounded-pill fw-bold shadow-sm me-2" onclick="return confirm('Approve this booking?')">
                                                <i class="bi bi-check-circle me-1"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill fw-bold shadow-sm" onclick="return confirm('Reject this booking?')">
                                                <i class="bi bi-x-circle me-1"></i> Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
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