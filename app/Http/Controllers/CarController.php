<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // If you want to filter by branch, use ?branch_id=xx in the URL
        $carsQuery = Car::query();
        if ($request->has('branch_id')) {
            $carsQuery->where('branch_id', $request->branch_id);
        }

        // Filter by status 'Available' by default
        $carsQuery->where('status', 'Available');

        $cars = $carsQuery->get();

        $admin = Admin::find(session('admin_id'));

        // For HQ
        return view('car.index', [
            'cars' => $cars,
            'admin' => $admin,
            'isHQ' => true,
        ]);

        // For branch staff
        return view('car.index', [
            'cars' => $cars->where('branch_id', $staffBranchId),
            'currentBranch' => $branch,
            'isHQ' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('car.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $car = Car::create([
            'branch_id' => $request->branch_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'type' => $request->type,
            'transmission' => $request->transmission,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $car->image = $filename;
            $car->save();
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $branches = Branch::all();
        return view('car.edit', compact('car', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $car->update([
            'branch_id' => $request->branch_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'type' => $request->type,
            'transmission' => $request->transmission,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $car->image = $filename;
            $car->save();
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}
