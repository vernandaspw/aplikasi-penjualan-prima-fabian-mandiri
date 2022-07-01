<?php

namespace App\Http\Middleware;

use App\Models\Pegawai;
use Closure;
use Illuminate\Http\Request;

class AdminIsLoginMiddleware
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
        if (auth('pegawai')->check()) {
            if (auth('pegawai')->user()->isaktif == true) {
                return $next($request);
            } else {
                auth('pegawai')->logout();
                session()->invalidate();
                session()->regenerateToken();
                return redirect('admin/login');
            }
        }
        return redirect('admin/login');
    }
}
