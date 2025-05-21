<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login — overridden in authenticated() method.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // will be ignored

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth:customer')->only('logout');
    }

    /**
     * Use the 'customer' guard instead of the default 'web'.
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * Redirect after successful login.
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('home');
    }

    /**
     * Override failed login response with a custom message.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            $message = 'Customer email not found.';
        } else {
            $message = 'Incorrect password.';
        }

        throw ValidationException::withMessages([
            $this->username() => [$message],
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            session(['customer_id' => $customer->id]);
            session()->forget('admin_id');
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
