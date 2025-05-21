<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Branch;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Admin;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin || $admin->branch_id != 1) {
            return back()->with('error', 'You cannot enter this page.');
        }

        $branches = Branch::all();
        return view('admin.dashboard', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Branch::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        $cars = $branch->cars; // Assuming Branch has a cars() relationship

        return view('branches.show', compact('branch', 'cars'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $branch->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }

    /**
     * Display the booking index.
     */
    
}
