<!--landing page for Easy Car Enterprise-->

@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Welcome message with background -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="p-5 mb-4 bg-gradient rounded-4 shadow text-center" style="background: linear-gradient(90deg, #ffecd2 0%, #fcb69f 100%); color: #333;">
                <h1 class="display-4 fw-bold mb-2">Welcome to Easy Car Enterprise</h1>
                <p class="lead mb-0" style="color: #fff;">Where Convenience Meets the Road</p>
            </div>
        </div>
    </div>

    <!-- Carousel with captions and indicators -->
    <div id="gallery" class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div id="mainCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/car1.png') }}" class="d-block w-100" alt="Car 1" style="height: 350px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                            <h5>Luxury & Comfort</h5>
                            <p>Experience the best rides with our premium cars.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/car2.jpg') }}" class="d-block w-100" alt="Car 2" style="height: 350px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                            <h5>Family Friendly</h5>
                            <p>Spacious vehicles for your family adventures.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/car3.jpg') }}" class="d-block w-100" alt="Car 3" style="height: 350px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                            <h5>Business Ready</h5>
                            <p>Arrive in style for your next business trip.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Features section with icons -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 text-center">
            <h3 class="fw-bold mb-4">Why Choose Us?</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-car-front-fill display-4 text-primary"></i>
                            </div>
                            <h5 class="card-title">Wide Selection</h5>
                            <p class="card-text">Choose from various types of cars to fit your needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-cash-coin display-4 text-success"></i>
                            </div>
                            <h5 class="card-title">Transparent Pricing</h5>
                            <p class="card-text">No hidden fees. What you see is what you pay.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-people-fill display-4 text-warning"></i>
                            </div>
                            <h5 class="card-title">Friendly Service</h5>
                            <p class="card-text">Our team is here to help you every step of the way.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Contact Section -->
    <div id="contact" class="row justify-content-center mt-5 mb-4">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg">
                <div class="row g-0">
                    <div class="col-md-6 p-4">
                        <h4 class="fw-bold mb-3">Contact Information</h4>
                        <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Kuala Lumpur, Malaysia</p>
                        <p class="mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i>+60 12-345 6789</p>
                        <p class="mb-2"><i class="bi bi-envelope-fill me-2 text-success"></i>info@easycar.com</p>
                        <p class="mb-0"><i class="bi bi-clock-fill me-2 text-warning"></i>Mon - Sun: 8:00 AM - 8:00 PM</p>
                    </div>
                    <div class="col-md-6">
                        <iframe 
                            src="https://www.google.com/maps?q=Kuala+Lumpur,+Malaysia&output=embed"
                            width="100%" height="250" style="border:0; border-radius: 0 0 1rem 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
