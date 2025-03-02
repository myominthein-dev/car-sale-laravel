<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
                'model' => 'required|exists:car_models,id',
                'year' => 'required|integer|between:1900,' . date('Y'),
                'car_type' => 'required|exists:car_types,id',
                'price' => 'required|numeric|min:0',
                'vin_code' => 'required|string|max:17|unique:cars,vin,' . $this->car->id,
                'mileage' => 'required|numeric|min:0',
                'fuel_type' => 'required|exists:fuel_types,id',
                'state' => 'required|exists:states,id',
                'city' => 'required|exists:cities,id',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'description' => 'nullable|string|min:10',
                'features' => 'array',
                'features.*' => 'boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:4096', 
        ];
    }

    public function messages()
    {
        return [
            'maker.required' => 'Please select a car maker',
                'model.required' => 'Please select a car model',
                'year.required' => 'Please select the car year',
                'car_type.required' => 'Please select a car type',
                'price.required' => 'Please enter the car price',
                'price.numeric' => 'Price must be a number',
                'vin_code.required' => 'Please enter the VIN code',
                'vin_code.unique' => 'This VIN code is already registered',
                'mileage.required' => 'Please enter the mileage',
                'mileage.numeric' => 'Mileage must be a number',
                'fuel_type.required' => 'Please select a fuel type',
                'state.required' => 'Please select a state',
                'city.required' => 'Please select a city',
                'address.required' => 'Please enter the address',
                'phone.required' => 'Please enter a contact phone number',
                'description.min' => 'Description must be at least 10 characters long',
                'images.*.image' => 'File must be an image',
                'images.*.max' => 'Image size should not exceed 4MB',
        ];
    }
}
