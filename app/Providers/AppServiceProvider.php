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
     * Hier werden Variablen für jede Dashboard Request deklariert.
     * Diese werden für das Hauptlayout benötigt:
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['dashboard', 'home.*'], function ($view) {
            
            // Der aktuell angemeldete Benutzer
            $user = \Auth::user();
            
            // ggf. Das aktuelle Fahrzeug, ansonsten das Main Vehicle
            if(session('vehicle') == null || session('vehicle') == '') {
                session(['vehicle' => $user->setting->vehicle->id]);
            }

            $vehicle = \App\Vehicle::find(session('vehicle'));


            // Variablen werden an Dashboard Views weitergegeben
            $view->with([
                'user' => $user,
                'vehicle' => $vehicle,
                'recentDeps' => $this->getReminderItems($vehicle)
            ]);
        });
    }

    /**
     * Sortiert die aktuellsten Dependency Einträge eines Vehicles für das
     * aside Element in allen Dashboard Views
     *
     * @param \App\Vehicle $vehicle
     * @return \App\Dependency[]
     */
    public function getReminderItems($vehicle)
    {
        $dependencies = \App\Dependency::where('vehicle_id', $vehicle->id)->get();

        return $dependencies;
    }
}
