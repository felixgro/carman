<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $mainVehicle = $user->setting->vehicle;
        $userVehicles = \DB::table('vehicles')
                            ->where('user_id', '=', \Auth::user()->id)
                            ->orderBy('make', 'desc')
                            ->get();

        return view('home.vehicles.all', [
            'title' => 'Vehicle Dashboard',
            'userVehicles' => $userVehicles,
            'currentPage' => 'vehicle'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        $mainVehicle = $user->setting->vehicle;

        return view('home.vehicles.create', [
            'title' => 'Home Dashboard',
            'vehicle' => $mainVehicle,
            'user' => $user,
            'currentPage' => 'vehicle',
            'types' => \App\VehicleType::all(),
            'fuels' => \App\VehicleFuel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        \DB::table('vehicles')->insert([
            'user_id' => \Auth::user()->id,
            'vehicle_type_id' => $data['type'],
            'vehicle_fuel_id' => $data['fuel'],
            'make' => $data['make'],
            'model' => $data['model'],
            'km' => $data['km'],
            'plate' => $data['plate']
        ]);

        return redirect('vehicles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    protected function validated($request)
    {
        return $request->validate([
            'type' => 'required|integer',
            'fuel' => 'required|integer',
            'model' => 'required',
            'make' => 'required',
            'km' => 'required|integer',
            'plate' => 'required'
        ]);
    }
}
