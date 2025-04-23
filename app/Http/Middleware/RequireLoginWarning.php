<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RequireLoginWarning
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)
    {
        if (!Auth::check()) {
            session()->flash('warning', 'Silakan login terlebih dahulu untuk mengakses dashboard.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
