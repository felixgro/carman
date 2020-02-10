<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    /**
     * Zeigt alle Vehicles
     * TODO: Sortierbar machen, Pagination
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.vehicles.all', [
            'title' => 'Vehicle Dashboard',
            'currentPage' => 'vehicles',
            'userVehicles' => \App\Vehicle::all()
        ]);
    }

    /**
     * Zeigt Formular zu erstellung eines Vehicle
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.vehicles.create', [
            'title' => 'Home Dashboard',
            'currentPage' => 'vehicles',
            'types' => \App\VehicleType::all(),
            'fuels' => \App\VehicleFuel::all()
        ]);
    }

    /**
     * Speichert neues Vehicle
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
            'vehicle_manufacturer_id' => $data['make'],
            'model' => $data['model'],
            'km' => $data['km'],
            'plate' => $data['plate']
        ]);

        $request->session()->flash('notification', ["Vehicle added", "{$data['make']} {$data['model']}"]);

        return redirect('vehicles');
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
            'currentPage' => 'vehicles',
            'editVehicle' => $vehicle,
            'manufacturers' => \App\VehicleManufacture::orderBy('title')->get(),
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
            'vehicle_manufacture_id' => $data['make'],
            'model' => $data['model'],
            'km' => $data['km'],
            'plate' => $data['plate']
        ]);

        $request->session()->flash('notification', ["Vehicle saved", "{$data['make']} {$data['model']}"]);

        return redirect('vehicles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle, Request $request)
    {

        if($vehicle->id === session('vehicle')) {
            $request->session()->flash('notification', ["You can't delete a vehicle which is current selected", "Cannot Delete"]);
            return back();
        }

        \DB::table('vehicles')->where('id', $vehicle->id)->delete();

        $request->session()->flash('notification', ["{$vehicle->make} {$vehicle->model}", "Deleted successfully."]);
        return redirect('vehicles');
    }

    /**
     * Wählt ein neues Vehicle aus
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function select(Vehicle $vehicle, Request $request)
    {
        session(['vehicle' => $vehicle->id]);
        $request->session()->flash('notification', ["Vehicle selected", "{$vehicle->vehicle_manufacture->title} {$vehicle->model}"]);
        return redirect('vehicles');
    }

    /**
     * Setzt ein neues Main Vehicle
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function main(Vehicle $vehicle, Request $request)
    {

        $user = \App\User::find(\Auth::user()->id);

        \DB::table('settings')->where('id', $user->setting->id)->update([
            'vehicle_id' => $vehicle->id,
        ]);

        // Setting: Fahrzeug kann direkt ausgewählt werden
        if ($user->setting->select_main === 1) {
            session(['vehicle' => $vehicle->id]);
        }

        $request->session()->flash('notification', ["set as new Main Vehicle", "{$vehicle->vehicle_manufacture->title} {$vehicle->model}"]);
        return redirect('vehicles');
    }

    /**
     *  Für AJAX-Request in vehicleList.js: Gibt alle Daten eines Vehicles als JSON zurück
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function getData(Vehicle $vehicle)
    {

        $allVehicleExpenses = \DB::table('expenses')->where('vehicle_id', $vehicle->id)->get();

        // Addiert alle Ausgaben, die mit dem Vehicle getätigt wurden
        $totalCost = 0;
        foreach($allVehicleExpenses as $expense) {
            $totalCost += $expense->amount;
        }

        $svg = str_replace("/", ".", $vehicle->vehicle_manufacture->icon);

        $data = [
            'id' => $vehicle->id,
            'make' => $vehicle->vehicle_manufacture->title,
            'make_icon' => view($svg)->render(),
            'type' => $vehicle->vehicle_type->title,
            'type_icon' => $vehicle->vehicle_type->icon,
            'fuel' => $vehicle->vehicle_fuel->title,
            'model' => $vehicle->model,
            'km' => $vehicle->km,
            'plate' => $vehicle->plate,
            'totalCost' => $totalCost,
            'totalKM' => 13034
        ];

        return response()->json($data);
    }
}
