<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\CarFeature;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\FavouriteCar;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $cars = Car::where('user_id', $userId)->get();

        return view('cars.index',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers= Maker::all();
        $models= CarModel::all();
        $states= State::all();
        $cities = City::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        return view('homePage.add-car-form', compact('makers','models','states','cities','carTypes','fuelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        
        
        $user_id = Auth::user()->id;
        $request['user_id'] = $user_id;
        
         $car = Car::create(['user_id' => $request->user_id,'maker_id' => $request->maker,'model_id' => $request->model,'car_type_id' => $request->car_type,'city_id' => $request->city,'fuel_type_id' => $request->fuel_type ,'year' => $request->year,'price' => $request->price,'vin' => $request->vin_code,'mileage' => $request->mileage,'address' => $request->address,'phone' => $request->phone,'phone' => $request->phone,'description' => $request->description]);

        $featuresData = array_merge([
            'car_id' => $car->id,
            'abs' => false,
            'air_conditioning' => false,
            'power_windows' => false,
            'power_door_locks' => false,
            'cruise_control' => false,
            'bluetooth_connectivity' => false,
            'remote_start' => false,
            'gps_navigation' => false,
            'heater_seats' => false,
            'climate_control' => false,
            'rear_parking_sensors' => false,
            'leather_seats' => false,
        ], $request->features ?? []);

        CarFeature::create($featuresData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                
                
                $newName = time().uniqid().'_'.$image->getClientOriginalName();
                $imagePath = $image->storeAs('car_images',$newName,'public');
                
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $newName
                    
                ]);
            }
        }

        return redirect()
            ->route('home.index')
            ->with('success', 'Car added successfully.');
    }
  

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {

        $makers= Maker::all();
        $models= CarModel::all();
        $states= State::all();
        $cities = City::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $carImages = CarImage::where('car_id', $car->id)->get();
        $carFeatures = CarFeature::where('car_id',$car->id)->first();
        $carFeatures = collect($carFeatures)->except('car_id');
        
        return view('cars.edit-car', compact('makers','models','states','cities','carTypes','fuelTypes','carImages','car', 'carFeatures'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    
   
        public function update(UpdateCarRequest $request, Car $car)
        {
                 
       
    
            $defaultFeatures = [
                'car_id' => $car->id,
                'abs' => false,
                'air_conditioning' => false,
                'power_windows' => false,
                'power_door_locks' => false,
                'cruise_control' => false,
                'bluetooth_connectivity' => false,
                'remote_start' => false,
                'gps_navigation' => false,
                'heater_seats' => false,
                'climate_control' => false,
                'rear_parking_sensors' => false,
                'leather_seats' => false,
            ];
        
            // Merge the request features with defaults
            $features = array_merge(
                $defaultFeatures,
                $request->features
            );
        
            // Update or create the features
            $car->carFeature()->update(
                $features 
            ); // Update car details
                $car->update([
                    'maker_id' => $request['maker'],
                    'model_id' => $request['model'],
                    'year' => $request['year'],
                    'car_type_id' => $request['car_type'],
                    'price' => $request['price'],
                    'vin_code' => $request['vin_code'],
                    'mileage' => $request['mileage'],
                    'fuel_type_id' => $request['fuel_type'],
                    'state_id' => $request['state'],
                    'city_id' => $request['city'],
                    'address' => $request['address'],
                    'phone' => $request['phone'],
                    'description' => $request['description'],
                ]);
    
    
                // Handle image uploads
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $index => $image) {
                        
                        $newName = time().uniqid().'_'.$image->getClientOriginalName();
                        $imagePath = $image->storeAs('car_images',$newName,'public');
    
                        // Create image record
                        $car->carImage()->create([
                            'image_path' => $newName
                            
                        ]);
                    }
                }
    
               
    
                return redirect()
                    ->route('cars.index')
                    ->with('success', 'Car updated successfully');
    
            
        }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if($car) {
            $car->delete();
            
            return redirect()->route('cars.index')->with('status', 'Sucessfully Deleted');
        }
    }

    public function search () {
        
    }

    public function addToWishList (Car $car) {


        
        $userId = Auth::user()->id;
        
        $isFavourited  = FavouriteCar::where('user_id',$userId)->where('car_id',$car->id)->first();
        

        if ($isFavourited) {
            $isFavourited->delete();
            return redirect()->back();
        }

        FavouriteCar::create(['user_id' => $userId, 'car_id' => $car->id]);
        return redirect()->back();
    }

    public function wishList () {
        $userId = Auth::user()->id;
        $wishedCars = FavouriteCar::where('user_id',$userId)->with('car','car.primaryImage')->get();
        return view('cars.wish-list',compact('wishedCars'));
    }
}
