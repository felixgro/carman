@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">
<link rel="stylesheet" href=" {{ asset('css/expenses.css') }}">

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script defer src="{{ asset('js/expensesChart.js') }}"></script>
<script defer src="{{ asset('js/form.js') }}"></script>

<h1>Your Expenses</h1>

<div class="container">
    <form class="toggle-scope basic-form">
        <select name="scope" id="scope" class="select-scope">
            <option value="all" selected>All</option>
            <option value="week">Last Week</option>
            <option value="year">Last Year</option>
        </select>
        <div class="multiple-choice" data-toggle=".select-scope">
            <div class="option selected" data-value="1">All</div>
            <div class="option" data-value="2">This Week</div>
            <div class="option" data-value="3">This Year</div>
        </div>
    </form>
    <div class="chart-container" style="padding: 50px; margin-bottom: -50px;">
        <canvas id="expensesChart" width="400" height="160" aria-label="Expenses Doughnut Chart" role="img"></canvas>
    </div>

    <div class="list">
    @foreach($expenses as $entry)
        <div class="list-item load-in" data-id="{{ $entry->id }}">
            <div class="icon">
                @include('vehicleTypes/car')
                <br>
                @include('vehicleIcons/bmw')
            </div>
            <div class="title">
                <h3>{{ $entry->title }}</h3>
                <small>{{ $entry->created_at }}</small>
            </div>
            <div class="side">
                {{ $entry->amount }} {{ $user->setting->currency->symbol }}
            </div>
        </div>
    @endforeach
    <table>
        <thead>
            <th></th>
            <th>Purchase</th>
            <th>Costs</th>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr tabindex="0">
                <td><i class="fas fa-money-bill-wave-alt expense-type-{{ $expense->expense_type_id }}"></i></td>
                <td class="title">
                    <a href="/expenses/{{ $expense->id }}" tabindex="-1">
                        <strong>{{ $expense->title }}</strong>
                    </a>
                    <br>
                        <span>
                            @php
                                $timestamp = new \Carbon\Carbon($expense->created_at);
                                echo $timestamp->toFormattedDateString();
                            @endphp
                        </span>
                </td>
                <td><strong>{{ $expense->amount }}</strong> EUR</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
</script>
@endsection