<link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">

@extends('dashboard')

@section('content')

<h1>Add new Vehicle</h1>
<p>Fill in all fields below. Hit the Save Button to add the new Vehicle to your Dashboard.</p>


<form action="/vehicles" method="post">
    @csrf
            <div id="clear">
                <a href="{{ Request::url() }}">clear all</a>
            </div>

            <div>
                <label for="type">Vehicle's Type</label>
                    <p>What kind of Vehicle do you want to add?</p>
                <select name="type" id="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for=fuel">Vehicle's Ressource</label>
                    <p>Where does it get energy from?</p>
                <select name="fuel" id="fuel">
                    @foreach ($fuels as $fuel)
                        <option value="{{ $fuel->id }}">{{ $fuel->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="model">Model</label>
                <p>Your Vehicle's model name ('A7' from Audi f.e.)</p>
                @error('model')
                    <span class="form-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" name="model" id="model" value="{{ old('model') }}">
            </div>

            <div>
                <label for="make">Vehicle Make</label>
                <p>Your Vehicle's producer ('Audi' f.e.)</p>
                @error('make')
                    <span class="form-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" name="make" id="make" value="{{ old('make') }}">
            </div>

            <div>
                <label for="km">Milage</label>
                <p>The total distance your Vehicle drove ('21 280' f.e.)</p>
                @error('km')
                    <span class="form-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" name="km" id="km" value="{{ old('km') }}">
            </div>

            <div>
                <label for="plate">License Plate</label>
                <p>The current License Plate (W-43292 f.e.)</p>
                @error('plate')
                    <span class="form-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" name="plate" id="plate" value="{{ old('plate') }}">
            </div>

            <div>
                <input type="submit" value="Save" name="submit">
            </div>
</form>





@endsection