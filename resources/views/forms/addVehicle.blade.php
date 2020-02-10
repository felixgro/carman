<script defer src="{{ asset('js/form.js') }}"></script>
<form class="basic-form vehicle-form" action="/vehicles" method="post">

    @csrf

    <div class="spacer">
        <label for="type">Vehicle Type</label>
        <p>Choose a Type</p>
        <select name="type" id="type" class="type-select">
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if($type->id == old('type')) selected @endif>{{ $type->title }}</option>
            @endforeach
        </select>
        <div class="multiple-choice" data-toggle=".type-select">
            @foreach($types as $type)
            <div class="option @if($type->id == old('type')) selected @endif" data-value="{{ $type->id }}">{{ $type->title }}</div>
            @endforeach
        </div>
    </div>
    <div class="spacer">
        <label for="fuel">Fuel</label>
        <p>Choose a Propellant</p>
        <select name="fuel" id="fuel" class="fuel-select">
            @foreach($fuels as $fuel)
            <option value="{{ $fuel->id }}" @if($fuel->id == old('fuel')) selected @endif>{{ $fuel->title }}</option>
            @endforeach
        </select>
        <div class="multiple-choice" data-toggle=".fuel-select">
            @foreach($fuels as $fuel)
            <div class="option @if($fuel->id == old('fuel')) selected @endif" data-value="{{ $fuel->id }}">{{ $fuel->title }}</div>
            @endforeach
        </div>
    </div>
    <div class="spacer">
        <label for="make">Manufacturer</label>
        <p>Choose a Brand</p>
        <select id="make" name="make">
            @foreach($manufacturers as $man)
            <option value="{{ $man->id }}" @if($man->id == old('make')) selected @endif>{{ $man->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="spacer">
        <label for="model">Model</label>
        <p>Model/Series Name</p>
        <input name="model" id="model" type="text" value="{{ old('model') }}"></input>
    </div>
    <div class="spacer">
        <label for="plate">Plate</label>
        <p>Current Plate</p>
        <input name="plate" id="plate" type="text" value="{{ old('plate') }}"></input>
    </div>
    <div class="spacer">
        <label for="km">Millage</label>
        <p>Current Millage</p>
        <input name="km" id="km" type="text" value="{{ old('km') }}"></input>
    </div>
    <div class="spacer">
        <button>Add Vehicle</button>
    </div>
</form>