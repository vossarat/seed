<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Owner
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
    	
    	dd($request);
        if( Auth::user()->id == $userId ){
	        return $next($request);
	    }
	    return redirect('noaccess');
    }
}
