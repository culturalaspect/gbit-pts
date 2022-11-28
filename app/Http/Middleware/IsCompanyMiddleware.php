<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user()){
            if(Auth::user()->role_id == 3){
                return $next($request);
            } else if(Auth::user()->role_id == 1) {
                return redirect()->to('admin/dashboard');
            }else if(Auth::user()->role_id == 2){
                return redirect()->to('bank/dashboard');
            } else {
                return redirect()->to('users/permissiondenied');
            }
        }

        return redirect()->to('users/login');
    }
}
