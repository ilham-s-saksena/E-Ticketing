<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->organization_id == null) {
            return redirect()->route('organization')->with('error', 'Kamu belum mengisi Organization, Harap mengisi organization terlebih dahulu');
        }
        return $next($request);
    }
}
