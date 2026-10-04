<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        if ((bool) $request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }
    public function store(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required', 'string']]);
        $emailOk = env('ADMIN_EMAIL', '') === $credentials['email'];
        $configured = (string) env('ADMIN_PASSWORD', '');
        $passwordOk = $configured !== '' && ($credentials['password'] === $configured);
        if (! $emailOk || ! $passwordOk) return back()->withInput($request->only('email'))->withErrors(['email' => 'Invalid administrator credentials.']);

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }
}
