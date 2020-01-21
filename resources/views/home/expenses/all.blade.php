@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">

<h1>Expenses</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<div class="container">
    <div class="sub-action">
        <a href="/expenses/new"><i class="fas fa-plus-square"></i> Add Expense</a>
    </div>
    <!--div-- id="donut-charts"></!--div-->

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
                    <a href="/expenses/{{ $expense->id }}" tabindex="-1">
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
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="{{ asset('js/Donut.js') }}"></script>
@endsection