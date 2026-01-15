<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['super-admin', 'Admin'])) {
            return $next($request);
        }

        // Not authorized for admin — redirect to user panel with message
        return redirect()->route('user.panel')->with('error', 'Anda tidak punya akses ke admin.');
    }
}
