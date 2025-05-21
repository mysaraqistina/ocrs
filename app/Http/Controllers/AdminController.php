<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Branch;
use App\Models\Booking; 
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Example: Get current admin (adjust this to your actual authentication/session logic)
        $admin = Admin::find($request->user()->id ?? 1); // Replace with your actual admin retrieval logic

        $branches = Branch::withCount([
            'cars',
            'bookings as pending_bookings_count' => function ($query) {
                $query->where('bookings.status', 'pending');
            }
        ])->get();

        $cars = Car::with('branch')->get();

        // HQ if branch_id == 1
        $isHQ = ($admin && $admin->branch_id == 1);

        return view('admin.index', [
            'branches' => $branches,
            'cars' => $cars,
            'isHQ' => $isHQ
        ]);
    }

    public function create()
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin || $admin->branch_id != 1) {
            abort(404);
        }

        $branches = Branch::all();
        return view('admin.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|max:50|confirmed',
        ]);

        Admin::create([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }

    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'approve') {
            $booking->status = 'approved';
            $booking->save();

            // Set the car as not available
            $car = $booking->car;
            $car->status = 'Not Available';
            $car->save();

            return redirect()->back()->with('success', 'Booking approved.');
        }

        if ($action === 'reject') {
            $booking->status = 'rejected';
            $booking->save();

            return redirect()->back()->with('success', 'Booking rejected.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && password_verify($request->password, $admin->password)) {
            // Store admin ID in session
            $request->session()->put('admin_id', $admin->id);
            // Optionally store admin name or branch_id if you use them
            $request->session()->put('admin_name', $admin->name);
            $request->session()->put('admin_branch_id', $admin->branch_id);

            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ])->withInput();
    }
}