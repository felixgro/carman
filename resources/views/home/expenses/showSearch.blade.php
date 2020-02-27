@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/expenses.css') }}">
<link rel="stylesheet" href=" {{ asset('css/cards.css') }}">

<h1>Search Expenses</h1>

<div class="container">
    @include('../forms/searchExpense')
</div>

<div class="expenses-list cards-list">
    @foreach($expenses as $entry)

        <div class="item load-in card-item" data-id="{{ $entry->id }}">

            <div class="upper">

                <div class="title">
                    <h3>{{ oneRowText( $entry->title ) }}</h3>
                </div>

            </div>

            <div class="under">

                <div class="icon">

                    <svg viewBox="0 0 2 2" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="1" cy="1" r="1" style="fill: {{ \App\ExpenseType::findorFail($entry->expense_type_id)->color }} "/>
                    </svg>

                </div>

                <div class="amount">
                    {{ $entry->amount }} {{ $user->setting->currency->symbol }}
                </div>

                <div class="date">
                    {{ dynamicDate( $entry->created_at ) }}
                </div>
    
            </div>
            
        </div>
    @endforeach
    </div>
@endsection