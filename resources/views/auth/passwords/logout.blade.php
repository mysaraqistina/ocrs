@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success mt-5 text-center">
        You have been logged out successfully.
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="btn btn-primary">Login Again</a>
    </div>
</div>
@endsection