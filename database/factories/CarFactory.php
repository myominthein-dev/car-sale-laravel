<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maker_id' => Maker::inRandomOrder()->first()->id,
            'model_id' => function (array $attributes) {
                return CarModel::where('maker_id',$attributes['maker_id'])->first()->id;
            },
            'year' => fake()->year(),
            'price' => ((int)(fake()->randomFloat(2,5,10))) * 10000,
            'vin' => strtoupper(fake()->text(15)),
            'mileage' => fake()->numberBetween(10000,50000),
            'car_type_id' => CarType::inRandomOrder()->first()->id,
            'fuel_type_id' => FuelType::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'description' => fake()->text(50),
            'published_at' => fake()->dateTimeBetween('-1 month' , 'now')
        ];
    }
}
