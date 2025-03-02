<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardCarController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StateController;
use App\Http\Middleware\MustBeAdmin;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('home',[HomeController::class,'index'])->name('home.index');
Route::get('home/search',[HomeController::class, 'search'])->name('home.search');
Route::get('home/showCar/{car}',[HomeController::class,'show'])->name('home.show');

Route::get('/', function () {
    return redirect()->route('home.index');
})->name('/');


Route::get('/dashboard', function () {
    $carTypesCount = CarType::count();
    $fuelTypesCount = FuelType::count();
    $makersCount = Maker::count();
    $modelsCount = CarModel::count();
    $regionsCount = State::count();
    $citiesCount = City::count();
    $usersCount = User::where('role_id','!=',1)->count();
    $carsCount = Car::count();
    return view('dashboard',compact('carTypesCount','fuelTypesCount','makersCount','modelsCount','regionsCount','citiesCount','usersCount','carsCount'));
})->middleware(['auth', 'verified'])->middleware(MustBeAdmin::class)->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cars',CarController::class);
    Route::get('/car/search',[CarController::class,'search'])->name('cars.search');
    Route::get('/car/add-to-wishList/{car}',[CarController::class,'addToWishList'])->name('cars.addToWishList');
    Route::get('/car/wish-list',[CarController::class,'wishList'])->name('cars.wishList');
    Route::get('about',function () {
        return 'about';
    })->name('about');
    Route::get('contact',function () {
        return 'contact';
    })->name('contact');
});


    // Routes for super admins
Route::prefix('dashboard')->middleware('auth')->group (function () {
    Route::resource('car-types', CarTypeController::class)->middleware(MustBeAdmin::class);
    Route::resource('fuel-types', FuelTypeController::class)->middleware(MustBeAdmin::class);
    Route::resource('makers', MakerController::class)->middleware(MustBeAdmin::class);
    Route::resource('models', CarModelController::class)->middleware(MustBeAdmin::class);
    Route::resource('states', StateController::class)->middleware(MustBeAdmin::class);
    Route::resource('cities', CityController::class)->middleware(MustBeAdmin::class);
    Route::resource('dashboard-cars', DashboardCarController::class)->middleware(MustBeAdmin::class);
    Route::resource('dashboard-users', DashboardUserController::class)->middleware(MustBeAdmin::class);
});

Route::get('/unauthorized', function () {
    return view('unauthorizedPage');
})->name('unauthorized');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('sth', function () {
    $hashedPassword = '$2y$12$1Ah5hZvefwOx4vlR7L6qlOdbDDScXtUO1SLcsinOhxVhm9iW70hb';
   $plainPassword = 'asdffdsa';

if (Hash::check($plainPassword, $hashedPassword)) {
    echo "Password matches!";
} else {
    echo "Password does not match.";
}
})->name('sth');

require __DIR__.'/auth.php';
