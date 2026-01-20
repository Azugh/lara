<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManager
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('home.index');
        }

        $user = Auth::user();

        $isManager = $user->roles()->where('name', 'manager')->exists();

        if (!$isManager) {
            return \response(403);
        }
        return $next($request);
    }
}
