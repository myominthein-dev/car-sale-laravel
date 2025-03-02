<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeature;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index () {
        $makers= Maker::all();
        $models= CarModel::all();
        $states= State::all();
        $cities = City::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        
        $latestCars = Car::with('CarImage','favouriteByUser')->paginate(12);
        
        return view('homePage.index',compact(['makers','models','states','cities','carTypes','fuelTypes','latestCars']));
    }

    

    public function show (Car $car) {
        $car = Car::with('favouriteByUser','user')->where('id',$car->id)->first();
        
        $carFeatures = CarFeature::where('car_id',$car->id)->first();
        $carFeatures = collect($carFeatures->toArray())->except('car_id');
        return view('homePage.car-details',compact('car','carFeatures'));
    }

    public function search(Request $request)
    {
       
        if (!$request->maker_id && !$request->model_id && !$request->state_id && !$request->city_id && !$request->car_type_id && !$request->fuel_type_id && !$request->year_from && !$request->year_to && !$request->price_from && !$request->price_to ) {
            return redirect()->route('home.index')->with('error','Please select at least one filter');
        }

        $makers= Maker::all();
        $models= CarModel::all();
        $states= State::all();
        $cities = City::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();

        $query = Car::query();
    
        $filters = [
            'maker_id', 'model_id', 'state_id', 'city_id', 'car_type_id',
            'fuel_type_id', 'year_from', 'year_to', 'price_from', 'price_to','mileage_from', 'mileage_to'
        ];
    
        foreach ($filters as $filter) {
            
            if ($request->filled($filter)) {
                $operator = str_contains($filter, '_from') ? '>=' : (str_contains($filter, '_to') ? '<=' : '=');
                $query->where(str_replace(['_from', '_to'], '', $filter), $operator, $request->$filter);
            }
        }
        $carsCount = $query->get()->count();
        $cars = $query->paginate(10)->appends($request->query());
    
        return view('homePage.searchedResult', compact(['makers','models','states','cities','carTypes','fuelTypes','cars','carsCount']));
    }
    
}
