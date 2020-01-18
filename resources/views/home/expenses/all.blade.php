@extends('dashboard')

<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">

@section('content')

<h1>Expenses</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<div class="container">

    <table>
        <thead>
            <th></th>
            <th>Purchase</th>
            <th>Costs</th>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr tabindex="0">
                <td></td>
                <td>
                    <a href="/expenses/{{ $expense->id }}/edit" tabindex="-1">
                        <strong>{{ $expense->title }}</strong>
                    </a>
                    <br>
                        <span>{{ $expense->created_at }}</span>
                </td>
                <td><strong>{{ $expense->amount }}</strong> EUR</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection