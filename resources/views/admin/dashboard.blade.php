@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">HQ Dashboard</h2>

    <div class="row mb-4">
        <!-- Staff Management -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">Staff Management</div>
                <div class="card-body">
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-primary mb-2 w-100">Manage Staff</a>
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-success mb-2 w-100">Add New Staff & Assign Branch</a>
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-outline-info mb-2 w-100">Manage Branches</a>
                </div>
            </div>
        </div>
        <!-- System Operations -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">System Operations</div>
                <div class="card-body">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-primary mb-2 w-100">Manage Car Inventory</a>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-success mb-2 w-100">Approve/Reject Bookings</a>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info mt-4">
        <strong>Note:</strong> Staff assigned to a branch can only manage cars and bookings for their branch. HQ staff can manage all branches, staff, cars, and bookings.
    </div>
</div>
@endsection