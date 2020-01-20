@extends('dashboard')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.15.0/d3.min.js"></script>
<script src="{{ asset('js/Donut.js') }}"></script>

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">

<h1>Expenses</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<div class="container">

    <div id="chart"></div>

    <table>
        <thead>
            <th></th>
            <th>Purchase</th>
            <th>Costs</th>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr tabindex="0">
                <td><i class="fas fa-money-bill-wave"></i></td>
                <td class="title">
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