@extends('dashboard')

<link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">

@section('content')
<a href="{{ route('vehicles') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>Edit Vehicle</h1>
<p>Change all the fields below to your wishes. Hit the Save Button once your done.</p>

<div class="container">
    <form action="/vehicles/{{ $editVehicle->id }}" method="post">
    @method('PUT')
        @csrf
    
                <div>
                    <label for="type">Vehicle's Type</label>
                    <p>What kind of Vehicle do you want to add?</p>
                    @error('type')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <select name="type" id="type">
                        <option value="">Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if($type->id == $editVehicle->vehicle_type_id) selected="selected" @endif>{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <label for=fuel">Vehicle's Ressource</label>
                    <p>Where does it get energy from?</p>
                    @error('fuel')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <select name="fuel" id="fuel">
                        <option value="">Ressource</option>
                        @foreach ($fuels as $fuel)
                            <option value="{{ $fuel->id }}" @if($fuel->id == $editVehicle->vehicle_fuel_id) selected="selected" @endif>{{ $fuel->title }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <label for="model">Model</label>
                    <p>Your Vehicle's model name ('A7' from Audi f.e.)</p>
                    @error('model')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="model" id="model" value="{{ $editVehicle->model }}" @error('model') class="error" @enderror>
                </div>
    
                <div>
                    <label for="make">Vehicle Make</label>
                    <p>Your Vehicle's producer ('Audi' f.e.)</p>
                    @error('make')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="make" id="make" value="{{ $editVehicle->make }}" @error('make') class="error" @enderror>
                </div>
    
                <div>
                    <label for="km">Milage</label>
                    <p>The total distance your Vehicle drove ('21 280' f.e.)</p>
                    @error('km')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="km" id="km" value="{{ $editVehicle->km }}" @error('km') class="error" @enderror>
                </div>
    
                <div>
                    <label for="plate">License Plate</label>
                    <p>The current License Plate (W-43292 f.e.)</p>
                    @error('plate')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="plate" id="plate" value="{{ $editVehicle->plate }}" @error('plate') class="error" @enderror>
                </div>
    
                <div>
                    <input type="submit" value="Save Changes" name="submit">
                </div>
    </form>
</div>

@endsection