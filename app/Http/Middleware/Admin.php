<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
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
        if(Auth::check() && auth()->user()->isAdmin == 1){
                return $next($request);
            }
            else { 
                 return redirect()->back();
            }
         // return redirect('/signup')->with('error',"Only admin can access!");
    }
}
