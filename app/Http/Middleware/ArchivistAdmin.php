<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArchivistAdmin
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
        if(!auth()->check()){
            return redirect('/archivist/login');
        }

        if(auth()->user()->role == "admin"){
            return $next($request);
        }

        return redirect()->back()->with(‘error’,"You don't have admin access.");
        // if(auth()->check()){
        //     if(auth()->user()->role == 'customer'){
        //         return redirect('/archivist/login');
        //     }
        // }
        // return $next($request);
    }
}
