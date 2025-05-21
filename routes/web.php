<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

// Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// Customer Registration
Route::get('/register', [CustomerController::class, 'create'])->name('auth.register');
Route::post('/register', [CustomerController::class, 'store'])->name('customers.store');

// Customer Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('customer.logout');

// Admin Login & Logout
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Customer Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Customer Bookings
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

// Admin Dashboard (summary page)
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

// Admin Bookings Page (all bookings, admin view)
Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');

// Admin Resources
Route::resource('/admin/admins', AdminController::class)->names('admin.admins');
Route::resource('/admin/customers', CustomerController::class)->except(['create', 'store'])->names('admin.customers');
Route::resource('/admin/cars', CarController::class)->names('admin.cars');
Route::resource('/admin/branches', BranchController::class)->names('admin.branches');
Route::resource('/admin/bookings', BookingController::class)->except(['store', 'create', 'index'])->names('admin.bookings');

// Admin Booking Update (manual route)
Route::put('/admin/bookings/{id}', [AdminController::class, 'update'])->name('admin.bookings.update');

// Admin Create Staff
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
