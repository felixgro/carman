@extends('dashboard')

@section('content')
<a href="{{ route('expenses') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>{{ $expense->amount }}€ {{ $expense->title }}</h1>
<small>{{ $expense->created_at }}</small>
<p>{{ $expense->description }}</p>

@endsection