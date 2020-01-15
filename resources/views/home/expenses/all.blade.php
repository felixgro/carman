@extends('dashboard')

@section('content')

<h1>Expenses</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<br>
<ul>
    @foreach($expenses as $expense)
        <li>
            <a href="/expenses/{{ $expense->id }}">{{ $expense->title }} ({{ $expense->amount }} €)</a>
        </li>
    @endforeach
</ul>

@endsection