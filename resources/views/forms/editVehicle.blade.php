<form class="basic-form vehicle-form" action="/vehicles/{{ $editVehicle->id }}" method="post">
    @method('PUT')
    @csrf

    <div class="spacer load-in">
        <label for="type">Vehicle Type</label>
        <p>Choose a Type</p>
        <select name="type" id="type">
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if($type->id == $editVehicle->vehicle_type->id) selected @endif>{{ $type->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="spacer load-in">
        <label for="make">Manufacturer</label>
        <p>Choose a Brand</p>
        <select id="make" name="make">
            @foreach($manufacturers as $man)
            <option value="{{ $man->id }}" @if($man->id == $editVehicle->vehicle_manufacture->id) selected @endif>{{ $man->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="spacer load-in">
        <label for="fuel">Fuel</label>
        <p>Choose a Propellant</p>
        <select name="fuel" id="fuel">
            @foreach($fuels as $fuel)
            <option value="{{ $fuel->id }}" @if($fuel->id == $editVehicle->vehicle_fuel->id) selected @endif>{{ $fuel->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="spacer load-in">
        <label for="model">Model</label>
        <p>Model/Series Name</p>
        <input name="model" id="model" type="text" value="{{ $editVehicle->model }}"></input>
    </div>
    <div class="spacer load-in">
        <label for="plate">Plate</label>
        <p>Current Plate</p>
        <input name="plate" id="plate" type="text" value="{{ $editVehicle->plate }}"></input>
    </div>
    <div class="spacer load-in">
        <label for="km">Millage</label>
        <p>Current Millage</p>
        <input name="km" id="km" type="text" value="{{ $editVehicle->km }}"></input>
    </div>
    <div class="spacer load-in">
        <button>Save changes</button>
        <button class="sub-action" onclick="
            event.preventDefault();
            document.getElementById('deleteForm').submit();
        ">Delete</button>
    </div>
</form>
<form method="POST" action="/vehicles/{{ $editVehicle->id }}" style="display: hidden;" aria-hidden="true" id="deleteForm">
@method('DELETE')
@csrf
</form>