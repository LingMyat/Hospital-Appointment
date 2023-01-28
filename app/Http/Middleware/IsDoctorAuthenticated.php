<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDoctorAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('doctorLoggedIn')) {
            return $next($request);
        }
        return  to_route('doctor.loginPage')->with('error', 'Please login to your account.');

    }
}
