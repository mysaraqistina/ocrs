@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Staff</h2>

    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Staff Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Staff Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="branch_id" class="form-label">Assign to Branch</label>
            <select class="form-select" id="branch_id" name="branch_id" required>
                <option value="">-- Select Branch --</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
            @error('branch_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Add Staff</button>
        <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection