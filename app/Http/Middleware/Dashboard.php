<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Dashboard
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
		if(1==6){
	        return $next($request);
	    }
	    return redirect('/')->with('message','You have not admin access');
	}
}
