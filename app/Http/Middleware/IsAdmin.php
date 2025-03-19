<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('clients')->check() || Auth::guard('clients')->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Accès refusé. Vous devez être administrateur.');
        }

        return $next($request);
    }
}
