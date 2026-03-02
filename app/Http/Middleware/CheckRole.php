<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $membership = \App\Models\memberships::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        if (!$membership || $membership->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
