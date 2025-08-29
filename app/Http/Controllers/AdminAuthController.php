<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Pin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Response;      


class AdminAuthController extends Controller
{
    /**
    * Show the admin login form.
    */
   
    public function showLogin(): Response
{
    $loginView = cache()->remember('admin_login_page', 60, function () {
        return view('admin.login')->render(); // cached HTML
    });

    return response($loginView);
}

    /**
    * Handle admin login attempt.
    */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // clear cached dashboard data on successful login
            cache()->forget('dashboard_data_' . auth()->id());

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
    * Admin dashboard.
    */
    public function dashboard(): View
    {
        // Cache dashboard data per user for 60 seconds
        $data = cache()->remember('dashboard_data_' . auth()->id(), 60, function () {
            return [
                'totalMessages'  => ContactMessage::count(),
                'todaysMessages' => ContactMessage::whereDate('created_at', now()->toDateString())->count(),
                'weeksMessages'  => ContactMessage::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'pins'           => Pin::where('user_id', auth()->id())->latest()->get(),
            ];
        });

        return view('admin.dashboard', $data);
    }

    /**
    * Logout the current user.
    */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // clear cached dashboard data on logout
        cache()->forget('dashboard_data_' . auth()->id());

        return redirect()->route('admin.login');
    }
}
