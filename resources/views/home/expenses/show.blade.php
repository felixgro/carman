@extends('dashboard')

@section('content')
<a href="{{ route('expenses') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>{{ $expense->amount }}€ {{ $expense->title }}</h1>
<small>{{ $expense->created_at }}</small>
<p>{{ $expense->description }}</p>

<form action="/expenses/{{ $expense->id }}/edit" method="GET">
    @csrf
    <input type="submit" value="Edit Expense">
</form>
<form action="/expenses/{{ $expense->id }}" method="POST">
    @method('DELETE')
    @csrf
    <input type="submit" value="Delete Expense">
</form>

@endsection