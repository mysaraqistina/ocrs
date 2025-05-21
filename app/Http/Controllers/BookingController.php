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
        // Get customer by query string or fallback to first customer
        $customer = null;
        if ($request->has('customer_id')) {
            $customer = Customer::find($request->customer_id);
        }
        if (!$customer) {
            $customer = Customer::first();
        }

        $bookings = Booking::with('car')
            ->where('customer_id', $customer->id)
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('booking.index', compact('bookings', 'customer'));
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
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $booking = Booking::create([
            'car_id' => $request->car_id,
            'customer_id' => $request->customer_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        // Redirect with customer_id so index page always has it
        return redirect()->route('bookings.index', ['customer_id' => $request->customer_id])
            ->with('success', 'Booking submitted successfully.');
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
        } elseif ($request->action === 'reject') {
            $booking->status = 'rejected';
        }

        $booking->save();

        // Redirect with customer_id
        return redirect()->route('bookings.index', ['customer_id' => $booking->customer_id])
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove (cancel) the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->status = 'cancelled';
        $booking->save();

        // Redirect with customer_id
        return redirect()->route('bookings.index', ['customer_id' => $booking->customer_id])
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $admin = Admin::find(session('admin_id'));

        if ($admin->branch_id == 1) {
            // HQ: See all bookings
            $bookings = Booking::with(['car', 'customer', 'car.branch'])
                ->orderBy('start_date', 'desc')
                ->paginate(15);
        } else {
            // Branch staff: Only bookings for their branch
            $bookings = Booking::with(['car', 'customer', 'car.branch'])
                ->whereHas('car', function ($query) use ($admin) {
                    $query->where('branch_id', $admin->branch_id);
                })
                ->orderBy('start_date', 'desc')
                ->paginate(15);
        }

        return view('booking.index', [
            'bookings' => $bookings,
            'isAdmin' => true,
            'admin' => $admin,
        ]);
    }
}
