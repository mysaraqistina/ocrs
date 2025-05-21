@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">
        @if(!empty($isAdmin) && $isAdmin)
            All Bookings
        @else
            My Bookings
        @endif
    </h2>

    @if(!empty($isAdmin) && $isAdmin)
        <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">Back to Admin Dashboard</a>
    @elseif(isset($customer))
        <a href="{{ route('home', ['customer_id' => $customer->id]) }}" class="btn btn-secondary mb-3">Back to Homepage</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    @if(!empty($isAdmin) && $isAdmin)
                        <th>Customer</th>
                    @endif
                    <th>Car</th>
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
                    @if(!empty($isAdmin) && $isAdmin)
                        <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                    @endif
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
                            <span>{{ ucfirst($booking->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($isAdmin) && $isAdmin)
                            @if($booking->status == 'pending')
                                <form action="{{ route('admin.bookings.updateBooking', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this booking?')">Approve</button>
                                </form>
                                <form action="{{ route('admin.bookings.updateBooking', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this booking?')">Reject</button>
                                </form>
                            @endif
                        @else
                            @if($booking->status == 'pending')
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bookings->links() }}
    @endif
</div>
@endsection
