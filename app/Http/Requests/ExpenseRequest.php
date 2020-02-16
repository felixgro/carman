<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'current_timestamp' => 'required',
            'date' => 'nullable|date'
        ];
    }
    
    public function attributes()
    {
        return [
            'type' => 'Expense Type',
            'title' => 'Title',
            'amount' => 'Amount',
            'description' => 'Description',
            'date' => 'Date'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute Field is required.',
            'type.*' => 'Please select a :attribute.',
            'amount.numeric' => 'The :attribute must be a number (If you are using commas use the . Symbol)'
        ];
    }
}
