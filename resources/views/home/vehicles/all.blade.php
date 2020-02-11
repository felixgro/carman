@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">
<link rel="stylesheet" href=" {{ asset('css/vehicles.css') }}">

<div class="container">
    <h1>Your Vehicles</h1>
    @if(count($user->vehicles) < 2)
    <p class="short-txt">Below is a list containing all your registered Vehicles. To edit or delete an Entry just click on it's title.</p>
    @endif
    <form action="/vehicles/new" class="basic-form">
        <button>Add</button>
        <button class="sub-action" id="quickDelete">Delete</button>
    </form>
    <form action="/vehicles" method="post" id="quickDeleteForm" aria-hidden="true">
            @method('DELETE')
            @csrf
    </form>
    <div class="list">
    @foreach($userVehicles as $entry)
        <div class="list-item load-in" data-id="{{ $entry->id }}">
            <div class="icon">
                @include($entry->vehicle_type->icon)
                <br>
                @include($entry->vehicle_manufacture->icon)
            </div>
            <div class="title">
                <h3>{{ $entry->model }}</h3>
                <small>{{ number_format($entry->km) }} {{ $user->setting->unit }}</small>
            </div>
            <div class="side">
                {{ $entry->plate }}
            </div>
        </div>
    @endforeach
    </div>
    
</div>

<div class="side-box">

    <svg id="sideCloser" enable-background="new 0 0 386.667 386.667" height="512" viewBox="0 0 386.667 386.667" width="512" xmlns="http://www.w3.org/2000/svg">
        <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
    </svg>
    <div id="currentMakeIcon">
        @include('vehicleIcons/VW')
    </div>
    <h3>
        <span id="currentMake">VW</span>
        <span id="currentModel">Golf TDI</span>
    </h3>
    <small>
        <span id="currentKm">13.000</span> {{ $user->setting->unit }}
        /
        <span id="currentCosts">13.000</span>{{ $user->setting->currency->symbol }}
    </small>
    <div class="plate" id="currentPlate">W 92493</div>
    <div class="actions">
        <a id="currentSelect" href="#">Select</a>
        <a id="currentMain" href="#">Set Main</a>
        <a id="currentEdit" href="#">Edit</a>
    </div>

    <form action="" method="post" style="display:none;" aria-hidden="true" id="selectForm">
    @csrf
        <input type="number" name="userID" value="{{ $user->id }}">
    </form>

    <form action="" method="post" style="display:none;" aria-hidden="true" id="mainForm">
    @csrf
        <input type="number" name="userID" value="{{ $user->id }}">
    </form>
</div>

<script>
    // Inline Skript für Select/Set Main Action Buttons
    let selectForm = document.getElementById('selectForm');
    let mainForm = document.getElementById('mainForm');
    let selectBtn = document.getElementById('currentSelect');
    let mainBtn = document.getElementById('currentMain');

    selectBtn.onclick = (event) => {
        event.preventDefault();

        selectForm.submit();
    }
    mainBtn.onclick = (event) => {
        event.preventDefault();

        mainForm.submit();
    }
</script>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/vehicleList.js') }}"></script>

@endsection
