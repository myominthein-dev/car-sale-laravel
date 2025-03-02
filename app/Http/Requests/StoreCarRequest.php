<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'maker' => 'required|exists:makers,id',
            'model' => 'required|exists:car_models,id',
            'car_type' => 'required|exists:car_types,id',
            'fuel_type' => 'required|exists:fuel_types,id',
            'state' =>  'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|integer|min:0',
            'vin_code' => 'required|string|max:255|unique:cars,vin',
            'mileage' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:45',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:4096'
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
