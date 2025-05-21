@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="mb-3">
    @if(session()->has('admin_name'))
    <strong>Welcome, {{ session('admin_name') }}!</strong>
    @else
        <strong>Welcome, Admin!</strong>
    @endif

    </div>

    <!-- Branch summary section -->
    <div class="row mb-4">
        @foreach($branches as $branch)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header fw-bold">{{ $branch->name }}</div>
                    <div class="card-body">
                        <div>Total Cars: {{ $branch->cars_count }}</div>
                        <div>Pending Bookings: {{ $branch->pending_bookings_count }}</div>
                        <div>
                            <a href="{{ route('admin.branches.show', $branch->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Branch</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Manage buttons -->
    <div class="row mb-4">
        <div class="col-md-4">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-primary w-100 mb-2">Manage Cars</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-success w-100 mb-2">Manage Bookings</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.create') }}" class="btn btn-outline-info w-100 mb-2">Manage Staff</a>
        </div>
    </div>
 

    <!-- Car Inventory -->
    <div class="card">
        <div class="card-header">Car Inventory</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Branch</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($cars) && $cars->count())
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->branch->name ?? 'No Branch' }}</td>
                                <td>{{ $car->status }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No cars available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Logout Form 
    <div class="mt-4">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>-->
</div>
@endsection
