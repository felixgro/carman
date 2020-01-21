@extends('dashboard');

@section('content')
<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<h1>Dependencies</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>
<div class="container">
    @foreach($dep as $d)
    <div>
        <h5>{{ $d->created_at }}</h5>
        <p>{{ $d->title }}</p><br>
    </div>
    @endforeach
</div>
@endsection
