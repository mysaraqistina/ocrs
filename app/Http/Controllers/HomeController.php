<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Customer;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('customer_id')) {
            return redirect()->route('login');
        }

        $customerId = session('customer_id');
        $customer = Customer::find($customerId);

        // Get the latest booking for this customer
        $latestBooking = null;
        if ($customer) {
            $latestBooking = Booking::where('customer_id', $customer->id)->orderBy('id', 'desc')->first();
        }

        $carsQuery = Car::query()->with('branch');

        if ($request->filled('branch_id')) {
            $carsQuery->where('branch_id', $request->branch_id);
        }
        if ($request->filled('car_type')) {
            $carsQuery->where('type', $request->car_type);
        }
        if ($request->filled('transmission')) {
            $carsQuery->where('transmission', $request->transmission);
        }
        if ($request->filled('brand')) {
            $carsQuery->where('brand', $request->brand);
        }

        $carsQuery->where('status', 'Available');

        $cars = $carsQuery->get();

        return view('home', [
            'customer' => $customer,
            'latestBooking' => $latestBooking,
            'cars' => $cars,
            'branches' => Branch::all(),
            'brands' => Car::distinct()->pluck('brand'),
        ]);
    }
}
