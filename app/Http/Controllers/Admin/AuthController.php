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
        $emails = explode(',', env('ADMIN_EMAIL', ''));
        $passwords = explode(',', env('ADMIN_PASSWORD', ''));
        $emailOk = false;
        $passwordOk = false;
        foreach ($emails as $email) {
            if ($email === $credentials['email']) {
                $emailOk = true;
                break;
            }
        }
        foreach ($passwords as $password) {
            if ($password === $credentials['password']) {
                $passwordOk = true;
                break;
            }
        }
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
