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



<form aria-hidden="true" class="user-settings-form" style="display: none;">
    <input type="text" id="userCurrency" value="{{ $user->setting->currency->symbol }}">
    <input type="text" id="userCurrencyShort" value="{{ $user->setting->currency->short }}">
</form>



<h1>Your Expenses</h1>

<div id="noExpenses">
    Nothing to show..
</div>
<div class="container">

    <form class="toggle-scope basic-form">
        <select name="scope" id="scope" class="select-scope">
            <option value="all" selected>All</option>
            <option value="month">Last Month</option>
            <option value="year">Last Year</option>
        </select>
        <div class="multiple-choice" data-toggle=".select-scope">
            <div class="option selected" data-value="1">All</div>
            <div class="option" data-value="2">This Month</div>
            <div class="option" data-value="3">This Year</div>
        </div>
    </form>
    

    <div class="scope-data">

        <div class="main">
            <small>Total</small>
            <h2></h2>
            <small class="currency"></small>
        </div>

        <div class="smaller">
            <small>Gas Station</small>
            <h2 id="gasPercent"></h2>
        </div>
        
        <div class="smaller">
            <small>Service</small>
            <h2 id="servicePercent"></h2>
        </div>
        <div class="smaller">
            <small>Tickets</small>
            <h2 id="ticketPercent"></h2>
        </div>
        <div class="smaller">
            <small>Other</small>
            <h2 id="otherPercent"></h2>
        </div>
    </div>


    <div class="chart-container" style="padding: 50px; margin-bottom: -50px;">
        <canvas id="expensesChart" width="400" height="160" aria-label="Expenses Doughnut Chart" role="img"></canvas>
    </div>

    <form action="/expenses/new" class="basic-form" style="margin-top: 30px;">
        <button>Add Expense</button>
        <!--button-- class="sub-action" id="quickDelete">Delete</!--button-->
    </form>


    <div class="list">
    @foreach($expenses as $entry)
        <div class="list-item load-in" data-id="{{ $entry->id }}">
            <div class="icon">
            <svg viewBox="0 0 120 120" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="30" style="fill: 
                    @if($entry->expense_type_id == 1)
                    hsl(240, 30%, 35%)
                    @elseif($entry->expense_type_id == 2)
                    hsla(355, 80%, 58%, 1)
                    @elseif($entry->expense_type_id == 3)
                    hsl(40, 80%, 70%)
                    @else
                    lightgrey
                    @endif
                "/>
            </svg>
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
    </div>

<script>
</script>
@endsection