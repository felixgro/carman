@extends('dashboard')

@section('content')
<a href="{{ route('expenses') }}" class="return-button"><i class="fas fa-arrow-left"></i> return</a>
<h1>Edit Expense</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<div class="container">
    <form action="/expenses/{{ $expense->id }}" method="post">
        @method('PUT')
        @csrf

        <div>
            <label for="type">Expense Type</label>
            @error('type')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>What kind of Purchase do you want to add ?</p>
            <select name="type" id="type" @error('type') class="error" @enderror>
                <option value="">Choose a Type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if($type->id == $expense->expense_type_id) selected="selected" @endif>{{ $type->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="title">Title</label>
            @error('title')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>The Title of the expense (f.e. 'Motoroil')</p>
            <input type="text" name="title" id="title" value="{{ $expense->title }}" @error('title') class="error" @enderror>
        </div>

        <div>
            <label for="amount">Amount</label>
            @error('amount')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>The Amount of the Expense without currency (f.e. '13.4')</p>
            <input type="text" name="amount" id="amount" value="{{ $expense->amount }}" @error('amount') class="error" @enderror>
        </div>

        <div>
            <label for="description">Description</label>
            @error('description')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>You may add some details to the purchase. (not required)</p>
            <textarea name="description" id="description" rows="10" @error('description') class="error" @enderror>{{ $expense->description }}</textarea>
        </div>

        <div>
            <label for="date">Date</label>
            @error('date')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>The Date of Purchase. If don't want to change the date, leave this field empty.</p>
            <input type="date" name="date" id="date" value="{{ _('12.10.1999') }}" @error('date') class="error" @enderror>
        </div>

        <div>
            <input type="submit" value="Save Changes" name="submit">
        </div>

    </form>
</div>

@endsection