@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Branch: {{ $branch->name }}</h2>
    <p>Location: {{ $branch->location }}</p>

    <h3>Cars Available in this Branch</h3>

    @if($cars->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Transmission</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->type }}</td>
                        <td>{{ $car->transmission }}</td>
                        <td>
                            @if(strtolower($car->status) == 'available')
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Not Available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No cars found for this branch.</p>
    @endif

    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Back to Branch List</a>
</div>
@endsection
