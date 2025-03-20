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
            "Toyota" => ["Corolla", "Camry", "RAV4", "Highlander", "Prius", "Land Cruiser", "Tacoma"],
            "Ford" => ["F-150", "Mustang", "Explorer", "Escape", "Edge", "Bronco", "Fusion"],
            "Honda" => ["Civic", "Accord", "CR-V", "Pilot", "Fit", "HR-V", "Odyssey"],
            "Chevrolet" => ["Silverado", "Malibu", "Equinox", "Tahoe", "Camaro", "Suburban", "Traverse"],
            "Nissan" => ["Altima", "Rogue", "Sentra", "Pathfinder", "Versa", "Frontier", "Maxima"],
            "Lexus" => ["RX", "ES", "NX", "GX", "LS", "LX", "UX"],
            "BMW" => ["3 Series", "5 Series", "X3", "X5", "7 Series", "M3", "i4"],
            "Mercedes-Benz" => ["C-Class", "E-Class", "S-Class", "GLC", "GLE", "G-Wagon", "A-Class"],
            "Audi" => ["A4", "A6", "Q5", "Q7", "A8", "R8", "e-tron"],
            "Hyundai" => ["Elantra", "Sonata", "Tucson", "Santa Fe", "Kona", "Palisade", "Venue"],
            "Kia" => ["Forte", "Optima", "Sportage", "Sorento", "Telluride", "Seltos", "Stinger"],
            "Volkswagen" => ["Golf", "Jetta", "Passat", "Tiguan", "Atlas", "Beetle", "ID.4"],
            "Subaru" => ["Impreza", "Outback", "Forester", "Crosstrek", "Legacy", "Ascent", "WRX"],
            "Mazda" => ["Mazda3", "Mazda6", "CX-5", "CX-9", "MX-5 Miata", "CX-30", "CX-90"],
            "Tesla" => ["Model 3", "Model S", "Model X", "Model Y", "Cybertruck", "Roadster", "Semi"],
            "Jeep" => ["Wrangler", "Grand Cherokee", "Cherokee", "Renegade", "Compass", "Gladiator", "Wagoneer"],
            "Dodge" => ["Charger", "Challenger", "Durango", "Journey", "Ram 1500", "Dart", "Viper"],
            "GMC" => ["Sierra", "Yukon", "Acadia", "Terrain", "Canyon", "Hummer EV", "Envoy"],
            "Porsche" => ["911", "Cayenne", "Macan", "Panamera", "Taycan", "718 Boxster", "718 Cayman"],
            "Jaguar" => ["XE", "XF", "F-Type", "E-Pace", "F-Pace", "I-Pace", "XJ"],
            "Land Rover" => ["Range Rover", "Defender", "Discovery", "Velar", "Evoque", "Freelander", "Sport"]
        ];
        

        foreach ($makers as $maker => $models) {
            Maker::factory()->state(['name' => $maker])->has(CarModel::factory()->count(count($models))->sequence(...array_map(fn ($model) => ['name' => $model],$models)))->create();
        }

        $states = [
            "Yangon" => ["Yangon", "Thanlyin", "Hmawbi", "Twante", "Kyauktan"],
            "Mandalay" => ["Mandalay", "Pyin Oo Lwin", "Meiktila", "Kyaukse", "Amarapura"],
            "Ayeyarwady" => ["Pathein", "Hinthada", "Myaungmya", "Bogale", "Pyapon"],
            "Bago" => ["Bago", "Taungoo", "Pyay", "Nyaunglebin", "Tharrawaddy"],
            "Magway" => ["Magway", "Pakokku", "Minbu", "Yenangyaung", "Chauk"],
            "Sagaing" => ["Sagaing", "Monywa", "Shwebo", "Kale", "Tamu"],
            "Tanintharyi" => ["Dawei", "Myeik", "Kawthaung", "Palaw", "Tanintharyi"],
            "Kayin" => ["Hpa-An", "Myawaddy", "Kawkareik", "Thandaunggyi", "Hlaingbwe"],
            "Mon" => ["Mawlamyine", "Thaton", "Ye", "Paung", "Chaungzon"],
            "Rakhine" => ["Sittwe", "Thandwe", "Mrauk U", "Kyaukphyu", "Toungup"],
            "Shan" => ["Taunggyi", "Lashio", "Kengtung", "Muse", "Hsipaw"],
            "Kachin" => ["Myitkyina", "Bhamo", "Putao", "Mohnyin", "Waingmaw"],
            "Chin" => ["Hakha", "Falam", "Tedim", "Mindat", "Kanpetlet"],
            "Kayah" => ["Loikaw", "Demoso", "Hpruso", "Shadaw", "Bawlakhe"],
            "Naypyidaw" => ["Zabuthiri", "Ottarathiri", "Pobbathiri", "Dekkhinathiri", "Tatkon"]
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