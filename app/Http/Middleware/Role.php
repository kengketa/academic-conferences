<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if user is not authenticated
        }
        foreach ($roles as $role) {
            if ($user->roles->count() > 0 && $user->roles->contains('name', 'admin')) {
                return $next($request); // User has the required role, proceed
            }
        }
        return redirect()->route('index');
    }
}
