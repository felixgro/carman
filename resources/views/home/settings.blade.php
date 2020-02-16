@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<script defer src="{{ asset('js/form.js') }}"></script>

<h1>Settings</h1>
<form class="basic-form" method="POST" action="/settings/{{ $user->setting->id }}">
@method('PUT')
@csrf
    <div class="spacer">
        <label>
        Currency
        </label>
        <select name="currency" class="currency-select">
            @foreach($currencies as $c)
            <option value="{{ $c->id }}" @if($user->setting->currency->id == $c->id) selected @endif>{{ $c->title }}</option>
            @endforeach
        </select>
        <div class="multiple-choice" data-toggle=".currency-select">
            @foreach($currencies as $c)
            <div class="option @if($user->setting->currency->id == $c->id) selected @endif" data-value="{{ $c->id }}">{{ $c->short }}</div>
            @endforeach    
        </div>
    </div>
    <div class="spacer">
        <label>
        Unit
        </label>
        <select name="unit" class="unit-select">
            <option value="km" @if($user->setting->unit == 'km') selected @endif>km</option>
            <option value="mi" @if($user->setting->unit == 'mi') selected @endif>mi</option>
        </select>
        <div class="multiple-choice" data-toggle=".unit-select">
            <div class="option @if($user->setting->unit == 'km') selected @endif" data-value="1">km</div>
            <div class="option @if($user->setting->unit == 'mi') selected @endif" data-value="2">mi</div>  
        </div>
    </div>
    <div class="spacer">
        <label>
        <input type="checkbox" name="select_main" @if($user->setting->select_main == 1) checked @endif>
        select new Main-Vehicle when set
        </label>
    </div>
    <div class="spacer">
        <label>
        <input type="checkbox" name="show_expenses_percent" @if($user->setting->show_expenses_percent == 1) checked @endif>
        show Percent in Expenses Chart
        </label>
    </div>
    <div class="spacer">
        <button>Save Changes</button>
    </div>
</form>

@endsection
