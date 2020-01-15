<?php

namespace App\Http\Middleware;

use Closure;

class Expense
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
        $vehicle = \App\Vehicle::find($request['expense']);

        $condition = $vehicle->user_id === \Auth::User()->id;

        if(!$condition) {
            return redirect('expenses');
        }
        
        return $next($request);
    }
}
