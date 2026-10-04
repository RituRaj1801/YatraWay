<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
                // if ((bool) $request->session()->get('admin_authenticated')) {

        if (!  (bool) $request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.login')->with('error', 'Please sign in to access the admin area.');
        }
        return $next($request);
    }
}
