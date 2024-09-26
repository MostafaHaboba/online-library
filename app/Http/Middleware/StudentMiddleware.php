<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Ensure the user is authenticated and is a student
        if (Auth::check() && Auth::user()->role !== 'student') {
            return redirect('/notstudent')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
