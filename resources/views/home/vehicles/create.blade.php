@extends('dashboard')

<link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

@section('content')
<a href="{{ route('vehicles') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>Add new Vehicle</h1>
@if(count($userVehicles) < 2)
    <p>Fill in all fields below. Hit the Save Button to add the new Vehicle to your Dashboard.</p>
@else
    {{-- Spacing Korrektur --}}
    <div style="margin-bottom: -50px;"></div>
@endif

<div class="container" style="background: none;">
    <form action="/vehicles" method="post">
        @csrf
    
                <div>
                    <label for="type">Vehicle's Type</label>
                    @error('type')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>What kind of Vehicle do you want to add?</p>
                    <select name="type" id="type" @error('type') class="error" @enderror>
                        <option value="">Choose a Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if($type->id == old('type')) selected="selected" @endif>{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <label for=fuel">Vehicle's Ressource</label>
                    @error('fuel')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>Where does it get energy from?</p>
                    <select name="fuel" id="fuel" @error('fuel') class="error" @enderror>
                        <option value="">Choose a Ressource</option>
                        @foreach ($fuels as $fuel)
                            <option value="{{ $fuel->id }}" @if($fuel->id == old('fuel')) selected="selected" @endif>{{ $fuel->title }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <label for="model">Model</label>
                    @error('model')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>Your Vehicle's model name ('A7' from Audi f.e.)</p>
                    <input type="text" name="model" id="model" value="{{ old('model') }}" @error('model') class="error" @enderror>
                </div>
    
                <div>
                    <label for="make">Vehicle Make</label>
                    @error('make')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>Your Vehicle's producer ('Audi' f.e.)</p>
                    <input type="text" name="make" id="make" value="{{ old('make') }}" @error('make') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <label for="km">Milage</label>
                    @error('km')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>The total distance your Vehicle drove ('21 280' f.e.)</p>
                    <input type="text" name="km" id="km" value="{{ old('km') }}" @error('km') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <label for="plate">License Plate</label>
                    @error('plate')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <p>The current License Plate (W-43292 f.e.)</p>
                    <input type="text" name="plate" id="plate" value="{{ old('plate') }}" @error('plate') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <input type="submit" value="Add new Vehicle" name="submit">
                </div>
    </form>
</div>





@endsection