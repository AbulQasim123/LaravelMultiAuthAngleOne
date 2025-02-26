<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\Role;
use Illuminate\Http\Request;

class EmployeeAuthentication
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
        if (auth()->user() && auth()->user()->role == Role::EMPLOYEE) {
            return $next($request);
        }

        return redirect('/');
    }
}
