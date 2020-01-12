@extends('welcome')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<h1>Create Account</h1>

<form action="{{ route('register') }}" method="post">
    @csrf


    <fieldset class="name">
        <div>

            <label for="name">Full Name</label>
            <p>Fill in your full Name</p>
            @error('name')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" id="name" name="name" value="{{ old('name') }}">


            <label for="email">Email</label>
            <p>Enter a valid Email</p>
            @error('email')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" id="email" name="email" value="{{ old('email') }}">

        </div>
    </fieldset>


    <fieldset class="password">
        <div>

            <label for="password">Password</label>
            <p>Choose a secure one</p>
            @error('password')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" name="password" id="password">

        </div>
    </fieldset>


    <fieldset class="vehicle">
        
        <div>

            <select name="type" id="type">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <select name="fuel" id="type">
                @foreach ($fuels as $fuel)
                    <option value="{{ $fuel->id }}">{{ $fuel->title }}</option>
                @endforeach
            </select>

            <label for="model">Model</label>
            @error('model')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" name="model" id="model" value="{{ old('model') }}">

            <label for="make">Vehicle Make</label>
            @error('make')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" name="make" id="make" value="{{ old('make') }}">

            <label for="km">Total KM</label>
            @error('km')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" name="km" id="km" value="{{ old('km') }}">

            <label for="plate">License Plate</label>
            @error('plate')
                <span class="form-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" name="plate" id="plate" value="{{ old('plate') }}">
            

        </div>
    </fieldset>
    <input type="submit" value="Get Started">

</form>
@endsection
<!--div-- class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</!--div-->

