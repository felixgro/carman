@extends('dashboard')

<link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<style>
.container {
    width:600px !important;
    margin: 0 auto;
}
</style>
@section('content')

<div class="container">
    <a href="{{ route('vehicles') }}" class="return-button">
        <svg enable-background="new 0 0 330 330" version="1.1" viewBox="0 0 330 330" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
        <path d="m165 0c-90.981 0-165 74.019-165 165s74.019 165 165 165 165-74.019 165-165-74.019-165-165-165zm40.606 234.39c5.858 5.857 5.858 15.355 0 21.213-2.928 2.928-6.767 4.393-10.606 4.393s-7.678-1.464-10.606-4.394l-80-79.998c-2.813-2.813-4.394-6.628-4.394-10.606s1.58-7.794 4.394-10.607l80-80.002c5.857-5.858 15.355-5.858 21.213 0 5.858 5.857 5.858 15.355 0 21.213l-69.393 69.396 69.392 69.392z"/>
        </svg>
    </a>
    @include('../../forms/editVehicle')
</div>

@if(session('notification'))
    @component('components.alertSuccess')
        @slot('title')
            {{ session('notification')[0] }}
        @endslot
        {{ session('notification')[1] }}
    @endcomponent
@endif

@endsection