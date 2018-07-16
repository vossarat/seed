<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

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
		if( Auth::check() ) {
			if(Auth::user()->id == 1){
		        return $next($request);
		    }
		}
		
	    return redirect('sysmessage')->with('message','You have not admin access');
	}
}
