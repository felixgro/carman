@extends('dashboard')

@section('content')

<h1>Vehicles</h1>
<p>Below is a list of all your registered Vehicles. To edit or delete a Vehicle just click on it's title.</p>

<table>
    <thead>
        <th>Vehicle</th>
    </thead>
    <tbody>
        @foreach($userVehicles as $entry)

            <tr>
                <td>
                    <a href="/vehicles/{{ $entry->id }}/edit">
                        {{ $entry->make }} {{ $entry->model }}
                    </a>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>


@endsection
