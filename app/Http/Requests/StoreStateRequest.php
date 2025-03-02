<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:states,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The state name is required',
            'name.string' => 'The state name must be a string',
            'name.max' => 'The state name must not be greater than 255 characters',
            'name.unique' => 'The state name must be unique',
        ];
    }
}
