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
     * Wählt ein neues Vehicle aus
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function setCurrent(Request $request)
    {
        $vehicle = \App\Vehicle::find($request['vehicleID']);
        
        // Wenn das Fahrzeug nicht dem anfragenten Benutzer gehört wird 0 zurückgegen
        if($vehicle->user_id !== (int) $request['userID']) {
            return response(0);
        }

        session(['vehicle' => $vehicle->id]);
        // Wenn alles Funktioniert hat wird 1 zurückgegeben
        return response(1);
    }

    /**
     * Setzt ein neues Main Vehicle
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function setMain(Vehicle $vehicle, Request $request)
    {
        $request->session()->flash('notification', ["new Main Vehicle", "{$vehicle->make} {$vehicle->model}"]);
        return back();
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
            'make' => $data['make'],
            'model' => $data['model'],
            'km' => $data['km'],
            'plate' => $data['plate']
        ]);

        $request->session()->flash('notification', ["Vehicle added", "{$data['make']} {$data['model']}"]);

        return redirect('vehicles');
    }

    /**
     * Für AJAX: Gibt alle Daten eines Vehicles zurück
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
        \DB::table('vehicles')->where('id', $vehicle->id)->delete();

        $request->session()->flash('notification', ["{$vehicle->make} {$vehicle->model}", "Deleted successfully."]);
        return redirect('vehicles');
    }
}
