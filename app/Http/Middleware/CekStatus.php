<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = Auth::user()->status;
        // $user = User::();
        if (Auth::user()->status == '1') {
            return redirect('admin/dashboard');
        } elseif (Auth::user()->status == '2') {
            return redirect('mahasiswa/dashboard');
        }
        return $next($request);
    }
}
