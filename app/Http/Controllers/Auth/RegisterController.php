<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'types' => \App\VehicleType::all(),
            'fuels' => \App\VehicleFuel::all()
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $this->validation($request);

        dd($validatedData);
    }

    protected function validation($data)
    {
        return $data->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'type'      => 'required',
            'fuel'      => 'required',
            'make'      => 'required',
            'model'     => 'required',
            'plate'     => 'required',
            'km'        => 'required'
        ]);
    }

}
