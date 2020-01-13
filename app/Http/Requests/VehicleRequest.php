<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|integer',
            'fuel' => 'required|integer',
            'model' => 'required',
            'make' => 'required',
            'km' => 'required|integer',
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
