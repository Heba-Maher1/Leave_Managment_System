<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $role): Response
    {
        if($request->user()->role !== $role){
            if($request->user()->role === 'admin'){
                return redirect('/admin/dashboard')->with('error' , 'Not Authorize To Access');
            }else if($request->user()->role === 'employee'){
                return redirect('/employee/dashboard')->with('error' , 'Not Authorize To Access');
            }
            // return redirect('dashboard');
        }
        return $next($request);
    }
}
