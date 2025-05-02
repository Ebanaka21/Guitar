<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FilamentAccessControl
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->route('login');
            }

            return $next($request);
        }

        $user = Auth::user();

        if ((int)$user->role === 1) {
            if ($request->is('admin') || $request->is('admin/*')) {
                abort(403);
            }
        }

        return $next($request);
    }
}
