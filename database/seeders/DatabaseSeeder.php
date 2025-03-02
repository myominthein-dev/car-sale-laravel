<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $makers = [
            "Toyota" => ["Corolla", "Camry", "RAV4", "Highlander", "Prius"],
            "Ford" => ["F-150", "Mustang", "Explorer", "Escape", "Edge"],
            "Honda" => ["Civic", "Accord", "CR-V", "Pilot", "Fit"],
            "Chevrolet" => ["Silverado", "Malibu", "Equinox", "Tahoe", "Camaro"],
            "Nissan" => ["Altima", "Rogue", "Sentra", "Pathfinder", "Versa"],
            "Lexus" => ["RX", "ES", "NX", "GX", "LS"]
        ];

        foreach ($makers as $maker => $models) {
            Maker::factory()->state(['name' => $maker])->has(CarModel::factory()->count(count($models))->sequence(...array_map(fn ($model) => ['name' => $model],$models)))->create();
        }

        $states = [
            "California" => ["Los Angeles", "San Francisco", "San Diego", "Sacramento", "San Jose"],
            "Texas" => ["Houston", "Dallas", "Austin", "San Antonio", "Fort Worth"],
            "Florida" => ["Miami", "Orlando", "Tampa", "Jacksonville", "Tallahassee"],
            "New York" => ["New York City", "Buffalo", "Rochester", "Albany", "Syracuse"],
            "Illinois" => ["Chicago", "Aurora", "Naperville", "Springfield", "Peoria"],
            "Pennsylvania" => ["Philadelphia", "Pittsburgh", "Harrisburg", "Allentown", "Erie"],
            "Ohio" => ["Columbus", "Cleveland", "Cincinnati", "Toledo", "Akron"],
            "Georgia" => ["Atlanta", "Savannah", "Augusta", "Columbus", "Macon"],
            "North Carolina" => ["Charlotte", "Raleigh", "Durham", "Greensboro", "Winston-Salem"],
            "Michigan" => ["Detroit", "Grand Rapids", "Ann Arbor", "Lansing", "Flint"]
        ];

        foreach($states as $state => $cities) {
            State::factory()
            ->state(['name' => $state])
            ->has(
                City::factory()
                ->count(count($cities))
                ->sequence(...array_map(fn ($city) => ['name' => $city],$cities))
            )->create();
        }

        CarType::factory()->count(6)->sequence(['name'=>'SUV'],['name' => 'Hatchback'], ['name' => 'Sedan'],['name' => 'Hilux'], ['name' => 'PickUp Truck'],['name' => 'Mini Van'])->create();

        FuelType::factory()->count(5)->sequence(['name'=>'Gasoline'],['name' => 'Diesel'],['name' => 'Petrol'], ['name' => "Electric'"],['name' => 'Hybrid'])->create();

        //Create roles
        
        Role::create(['name' => 'admin','guard_name' => 'web']);
        Role::create(['name' => 'user','guard_name' => 'web']);

        // Create a super admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => '1',
            'phone' => '09 123 456 789',
            'password' => Hash::make('password'),
        ]);

        //Assign super admin role
        // $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());
    }
}