@extends('dashboard');

@section('content')
<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<h1>Dependencies</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>
<div class="container">
<div class="sub-action">
        <a href="/dependencies/new"><i class="fas fa-plus-square"></i> Add Dependency</a>
    </div>
    @foreach($dep as $d)
    <div>
        <h5>{{ $d->created_at }}</h5>
        <p>
            <a href="/dependencies/{{ $d->id }}">{{ $d->title }}</a>
        </p>
        <br>
    </div>
    @endforeach
</div>
@endsection
