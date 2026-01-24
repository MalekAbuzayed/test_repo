<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthBackendController extends Controller
{
    // =================================================================
    // ===================== showLoginForm =============================
    // ===================== Created By:Ahmad Obeidat ==================
    // =================================================================
    public function showLoginForm()
    {
        // super_admin
        if (Auth::guard('super_admin')->check()) {
            return redirect()->intended(route('super_admin.dashboard'));
        }

        return view('admin.auth.login');
    }

    // =================================================================
    // ===================== loginFormSubmit ===========================
    // ===================== Created By:Ahmad Obeidat ==================
    // =================================================================
    public function loginFormSubmit(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to user dashboard
            return redirect()->intended(route('super_admin.dashboard'));
        }

        // If unsuccessful
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Email or password is incorrect',
        ]);
    }

    // =================================================================
    // ===================== logout ====================================
    // ===================== Created By:Ahmad Obeidat ==================
    // =================================================================
    public function logout()
    {
        // super_admin
        if (Auth::guard('super_admin')->check()) {
            auth()->guard('super_admin')->logout();
        }

        return redirect('/');
    }
}
