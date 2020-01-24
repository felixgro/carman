@extends('dashboard');

@section('content')
<h1>Add new Vehicle</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

<div class="container">
    <form action="/dependencies" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            @error('title')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>Title of Dependency ('TÜF Check' f.e.)</p>
            <input type="text" name="title" id="title" value="{{ old('title') }}" @error('title') class="error" @enderror>
        </div>

        <div>
            <label for="description">Description</label>
            @error('description')
                <p class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            <p>You may add some details to the Dependency. (not required)</p>
            <textarea name="description" id="description" rows="10" @error('description') class="error" @enderror>{{ old('description') }}</textarea>
        </div>

        <div>
            <input type="submit" value="Add new Dependency" name="submit">
        </div>
    </form>
</div>

@endsection