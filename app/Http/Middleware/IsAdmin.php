<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'manager', 'Super Admin']) || auth()->user()->hasRole('customer')) {
            return redirect(route('welcome'))->with('error', 'Access Denied.');
        }
        return $next($request);
    }
}
