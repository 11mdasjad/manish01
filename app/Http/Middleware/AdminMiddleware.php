<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized access.'], 401);
            }
            return redirect()->route('admin.login')->with('error', 'Please authenticate to access the executive admin panel.');
        }

        if (!Auth::user()->isAdmin() && !Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Your account does not possess executive administrative clearance.');
        }

        return $next($request);
    }
}
