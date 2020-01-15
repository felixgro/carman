@extends('dashboard')

<link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">

@section('content')
<a href="{{ route('expenses') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>Add new Vehicle</h1>
<p>Fill in all fields below. Hit the Save Button to add the new Vehicle to your Dashboard.</p>

<div class="container">
    <div class="sub-action">
        <a href="{{ Request::url() }}">clear all</a>
    </div>
    <form action="/vehicles" method="post">
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
                            <option value="{{ $type->id }}" @if($type->id == old('type')) selected="selected" @endif>{{ $type->title }}</option>
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
                            <option value="{{ $fuel->id }}" @if($fuel->id == old('fuel')) selected="selected" @endif>{{ $fuel->title }}</option>
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
                    <input type="text" name="model" id="model" value="{{ old('model') }}" @error('model') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <label for="make">Vehicle Make</label>
                    <p>Your Vehicle's producer ('Audi' f.e.)</p>
                    @error('make')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="make" id="make" value="{{ old('make') }}" @error('make') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <label for="km">Milage</label>
                    <p>The total distance your Vehicle drove ('21 280' f.e.)</p>
                    @error('km')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="km" id="km" value="{{ old('km') }}" @error('km') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <label for="plate">License Plate</label>
                    <p>The current License Plate (W-43292 f.e.)</p>
                    @error('plate')
                        <p class="form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <input type="text" name="plate" id="plate" value="{{ old('plate') }}" @error('plate') class="error" @enderror('plate')>
                </div>
    
                <div>
                    <input type="submit" value="Add new Vehicle" name="submit">
                </div>
    </form>
</div>





@endsection