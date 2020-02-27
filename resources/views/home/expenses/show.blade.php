@extends('dashboard')

@section('content')
<style>
    .container {
        line-height: 1.8em !important;
    }
</style>
<div class="container">

    <small>{{ dynamicDate($expense->created_at) }}</small>
    <h1>{{ $expense->title }}</h1>
    <h4 class="price-tag">{{ $expense->amount }} {{ $user->setting->currency->short }}</h4>
    
    
    <p>{{ $expense->description }}</p>

    <form action="/expenses/{{ $expense->id }}/edit" class="basic-form">
        <button>Edit</button>
        <button class="sub-action" id="deleteButton">Delete</button>
    </form>
    <form action="/expenses/{{ $expense->id }}" method="post" aria-hidden="true" id="deleteForm">
        @method('DELETE')
        @csrf
    </form>
</div>



<script>
    document.getElementById('deleteButton').addEventListener('click', (event) => {
        event.preventDefault();
        document.getElementById('deleteForm').submit();
    });
</script>

@endsection