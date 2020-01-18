@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">

<h1>Vehicles</h1>
<p>Below is a list containing all your registered Vehicles. To edit or delete an Entry just click on it's title.</p>
<div class="container" style="padding: 10px 0">
    <div class="sub-action">
        <a href="/vehicles/new">new Vehicle</a>
    </div>

    <table id="vehicleTable">
        <thead>
            <th></th>
            <th>Vehicle</th>
            <th>Milage</th>
        </thead>
        <tbody>
            @foreach($userVehicles as $entry)
            <tr tabindex="0">
                <td>
                        
                    @if ($entry->vehicle_type_id === 2)
                    <i class="fas fa-motorcycle"></i>
                    @elseif ($entry->vehicle_type_id === 3)
                    {{-- Quad --}}
                    <i class="fas fa-motorcycle"></i>
                    @elseif ($entry->vehicle_type_id === 4)
                    {{-- Scooter --}}
                    <i class="fas fa-motorcycle"></i>
                    @else
                    <i class="fas fa-car"></i>
                    @endif

                </td>
                <td class="title">
                    <a href="/vehicles/{{ $entry->id }}/edit" tabindex="-1">
                    <strong>{{ $entry->make }}</strong> {{ $entry->model }}
                </a><br>
                    <span>{{ $entry->plate }}</span>
                </td>
                <td>
                    <strong>{{ number_format($entry->km) }}</strong>km
                </td>
                <td>

                </td>
            </tr>
    
            @endforeach
        </tbody>
    </table>
    
    <form action="/vehicles/new" style="max-width: 100%;">
        <input type="submit" value="Add new Vehicle" style="cursor: pointer;">
    </form>
</div>

@if(session('notification'))
    @component('components.alertSuccess')
        @slot('title')
            {{ session('notification')[0] }}
        @endslot
        {{ session('notification')[1] }}
    @endcomponent
@endif

<script src="{{ asset('js/vehicleList.js') }}"></script>
@endsection
