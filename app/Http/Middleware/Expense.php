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

        $expense = \App\Expense::findOrFail($request->expense);

        $vehicle = \App\Vehicle::find($expense->vehicle_id);

        if(!$vehicle || $vehicle == NULL) {
            return redirect('expenses');
        }

        $condition = $vehicle->user_id === \Auth::User()->id;

        if(!$condition) {
            return redirect('expenses');
        }
        
        return $next($request);
    }
}
