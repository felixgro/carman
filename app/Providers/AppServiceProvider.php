<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Vehicle;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('dashboard', function ($view) {
            $user = \Auth::user();
            $mainVehicle = $user->setting->vehicle;
            $userVehicles = \DB::table('vehicles')
                            ->where('user_id', '=', \Auth::user()->id)
                            ->orderBy('make', 'desc')
                            ->get();

            $view->with('user', $user);
            $view->with('vehicle', $mainVehicle);
            // $view->with('userVehicles', $userVehicles);
        });
    }
}
