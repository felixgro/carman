<?php

namespace App\Http\Middleware;

use Closure;

class Vehicle
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
        $condition = $request['vehicle']->user_id === \Auth::User()->id;

        if(!$condition) {
            return redirect('vehicles');
        }

        return $next($request);
    }
}
