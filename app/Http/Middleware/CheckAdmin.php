<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check()){
            return redirect()->route('home.index');
        }

        $user = Auth::user();

        $isAdmin = $user->roles()->where('name', 'admin')->exists();

        if(!$isAdmin) {
            return \response(403);
        }
        return $next($request);
    }
}
