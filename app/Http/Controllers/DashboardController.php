<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $mainVehicle = $user->setting->vehicle;

        return view('home.home', [
            'title' => 'Home Dashboard',
            'vehicle' => $mainVehicle,
            'user' => $user,
            'currentPage' => 'home'
        ]);
    }
}
