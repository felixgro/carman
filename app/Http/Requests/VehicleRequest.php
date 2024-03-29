<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Nur angemeldete User sind für diese Request authorisiert
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Die Validierungregeln
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'  => 'required|integer',
            'fuel'  => 'required|integer',
            'make'  => 'required|integer',
            'model' => 'required',
            'km'    => 'required|integer',
            'plate' => 'required'
        ];
    }
    





    public function attributes()
    {
        return [
            'type' => 'Vehicle Type',
            'fuel' => 'Vehicle Fuel',
            'model' => 'Vehicle Model',
            'make' => 'Vehicle Make',
            'km' => 'Vehicle Mileage',
            'plate' => 'License Plate'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'type.*' => 'Please select a :attribute.',
            'fuel.*' => 'Please select a :attribute.',
            'km.integer' => 'The :attribute field must be a number and should not contain the unit.'
        ];
    }
}
