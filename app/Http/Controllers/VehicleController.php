<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
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

        return view('home.vehicles.all', [
            'title' => 'Vehicle Dashboard',
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

        return view('home.vehicles.create', [
            'title' => 'Home Dashboard',
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
    public function store(VehicleRequest $request)
    {
        $data = $request->validated();

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
        return view('home.vehicles.edit', [
            'title' => 'Home Dashboard',
            'currentPage' => 'vehicle',
            'editVehicle' => $vehicle,
            'types' => \App\VehicleType::all(),
            'fuels' => \App\VehicleFuel::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();

        \DB::table('vehicles')->where('id', $vehicle->id)->update([
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
