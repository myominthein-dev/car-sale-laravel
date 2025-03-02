<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarImage>
 */
class CarImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "image_path" =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRScCnGvApNOLIZZPc6kw5C-0ePVAcFf8L6rQ&s" ,
            "position" => function (array $attributes) {
                return Car::find($attributes['car_id'])->CarImage()->count() + 1;
            }
        ];
    }
}
