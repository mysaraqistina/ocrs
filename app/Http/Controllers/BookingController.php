<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Car;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer = Customer::find(session('customer_id'));
        $today = now()->toDateString();

        $currentBooking = Booking::with('car')
            ->where('customer_id', $customer->id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc')
            ->first();

        $upcomingBookings = Booking::with('car')
            ->where('customer_id', $customer->id)
            ->where('start_date', '>', $today)
            ->orderBy('start_date', 'asc')
            ->get();

        $pastBookings = Booking::with('car')
            ->where('customer_id', $customer->id)
            ->where('end_date', '<', $today)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('booking.customer_index', [
            'customer' => $customer,
            'currentBooking' => $currentBooking,
            'upcomingBookings' => $upcomingBookings,
            'pastBookings' => $pastBookings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::where('status', 'available')->get();
        return view('booking.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $today = \Carbon\Carbon::today();

        // 1. At least 2 days in advance
        if ($startDate->lte($today->copy()->addDays(2))) {
            return back()->withErrors(['start_date' => 'Bookings must be made at least 2 days in advance.'])->withInput();
        }

        // 2. Prevent double bookings for the same car
        $overlap = Booking::where('car_id', $request->car_id)
            ->whereIn('status', ['pending', 'approved', 'confirmed'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($sub) use ($startDate, $endDate) {
                          $sub->where('start_date', '<=', $startDate)
                              ->where('end_date', '>=', $endDate);
                      });
            })->exists();

        if ($overlap) {
            return back()->withErrors(['car_id' => 'This car is already booked for the selected dates.'])->withInput();
        }

        // 3. Customer can book max 2 cars for the same period
        $customerOverlapCount = Booking::where('customer_id', $request->customer_id)
            ->whereIn('status', ['pending', 'approved', 'confirmed'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($sub) use ($startDate, $endDate) {
                          $sub->where('start_date', '<=', $startDate)
                              ->where('end_date', '>=', $endDate);
                      });
            })->count();

        if ($customerOverlapCount >= 2) {
            return back()->withErrors(['customer_id' => 'You can only book up to 2 cars for the same period.'])->withInput();
        }

        // If all checks pass, create the booking
        Booking::create([
            'car_id' => $request->car_id,
            'customer_id' => $request->customer_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'pending',
        ]);

        // Set car as not available immediately after booking
        $car = Car::find($request->car_id);
        if ($car) {
            $car->status = 'Not Available';
            $car->save();
        }

        return redirect()->route('bookings.index', ['customer_id' => $request->customer_id])
            ->with('success', 'Booking request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($request->action === 'approve') {
            $booking->status = 'approved';
            $booking->save();

            // Set the car as not available
            $car = $booking->car;
            if ($car) {
                $car->status = 'Not Available';
                $car->save();
            }
        } elseif ($request->action === 'reject') {
            $booking->status = 'rejected';
            $booking->save();

            // Set car as available
            $car = $booking->car;
            if ($car) {
                $car->status = 'Available';
                $car->save();
            }
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove (cancel) the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'You cannot cancel this booking.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        // Set car as available
        $car = $booking->car;
        if ($car) {
            $car->status = 'Available';
            $car->save();
        }

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // HQ sees all bookings, branch staff sees only their branch's bookings
        if ($admin->branch_id == 1) {
            $bookings = Booking::with(['car', 'customer'])->latest()->paginate(15);
        } else {
            // Get all car IDs for this branch
            $carIds = Car::where('branch_id', $admin->branch_id)->pluck('id');
            // Get bookings for those cars
            $bookings = Booking::with(['car', 'customer'])
                ->whereIn('car_id', $carIds)
                ->latest()->paginate(15);
        }

        return view('booking.admin_index', [
            'bookings' => $bookings,
            'isAdmin' => true,
            'admin' => $admin,
        ]);
    }
}
