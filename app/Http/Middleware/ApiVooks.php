<?php

namespace App\Http\Middleware;

use Closure;
use stdClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiVooks
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
        if($request->secrete !== "vooksbec618"){
            $c = new Controller();
            $m = new stdClass;
            $m->message = 'Unauthorized, invalid secrete key';
            return $c->convertJson('fail', 401, $m);
        }
        return $next($request);
    }
}
