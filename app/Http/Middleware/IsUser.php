<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == 'user') {
            return $next($request);
        } 
        //mengarahkan jika pengguna yang mencoba masuk bukan user/ admin mencoba masuk
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
