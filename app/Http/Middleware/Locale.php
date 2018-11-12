<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;

class Locale
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
        $locale = Session::get('locale');
        App::setLocale( $locale );
        
        return $next($request);
    }
}
