@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">
<link rel="stylesheet" href=" {{ asset('css/expenses.css') }}">
<link rel="stylesheet" href=" {{ asset('css/cards.css') }}">

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



<div class="container">
<h1>Your Expenses</h1>
    <form action="/expenses/new" class="basic-form">
        <button>Add Expense</button>
        <!--button-- class="sub-action" id="quickDelete">Delete</!--button-->
    </form>
<div id="noExpenses">
    Nothing to show..
</div>

    <form class="toggle-scope basic-form">
        <select name="scope" id="scope" class="select-scope">
            <option value="all" selected>All</option>
            <option value="month">Last Month</option>
            <option value="year">Last Year</option>
        </select>
        <div class="multiple-choice" data-toggle=".select-scope">
            <div class="option selected load-in scope-option" data-value="1">All</div>
            <div class="option load-in scope-option" data-value="2">This Month</div>
            <div class="option load-in scope-option" data-value="3">This Year</div>
        </div>
    </form>
    

    <div class="scope-data">

        <div class="main load-in">
            <small>Total</small>
            <h2></h2>
            <small class="currency"></small>
        </div>

        @if($user->setting->show_expenses_percent == 1)
        <div class="smaller load-in">
            <small>Gas Station</small>
            <h2 id="gasPercent"></h2>
        </div>
        
        <div class="smaller load-in">
            <small>Service</small>
            <h2 id="servicePercent"></h2>
        </div>
        <div class="smaller load-in">
            <small>Tickets</small>
            <h2 id="ticketPercent"></h2>
        </div>
        <div class="smaller load-in">
            <small>Other</small>
            <h2 id="otherPercent"></h2>
        </div>
        @endif

    </div>


    <div class="chart-container">
        <canvas id="expensesChart" width="400px" height="300px" aria-label="Expenses Doughnut Chart" role="img"></canvas>
    </div>
    <div class="global-spacer">
        <h4 class="load-in">Latest Expenses</h4>
        <div class="cards-list">
        @foreach($expenses as $entry)

            <div class="item load-in card-item" data-id="{{ $entry->id }}">

                <div class="upper">
                    <div class="title">
                        <h3>{{ oneRowText( $entry->title ) }}</h3>
                    </div>
                </div>

                <div class="under">
                    <div class="icon">
                        <svg viewBox="0 0 2 2" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="1" cy="1" r="1" style="fill:
                                {{ \App\ExpenseType::find($entry->expense_type_id)->color }} 
                            "/>
                        </svg>
                    </div>

                    <div class="amount">
                        {{ $entry->amount }} {{ $user->setting->currency->symbol }}
                    </div>

                    <div class="date">
                    {{ dynamicDate($entry->created_at) }}
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    
    <!--div class="expenses-navigation load-in">
        @if($expenses->currentPage() !== 1)
            <a href="{{ $expenses->previousPageURL() }}">< Back</a>
        @endif

        @if($expenses->currentPage() !== $expenses->lastPage())
            <a href="{{ $expenses->nextPageURL() }}">Next ></a>
        @endif
    </div-->

    <div class="global-spacer">
        <div class="expenses-search">
            <h4 class="load-in">Advanced Search</h4>
            <div class="load-in">
                @include('../forms/searchExpense')
            </div>
        </div>
    </div>
</div>

<script>
</script>
@endsection