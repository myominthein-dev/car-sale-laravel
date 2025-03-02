<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maker' => 'required|exists:makers,id',
            'name' => 'required|unique:car_models,name'
        ];
    }

    public function messages()
    {
        return [
            'maker.required' => 'The maker field is required.',
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name field must be unique.',
        ];
    }
}
