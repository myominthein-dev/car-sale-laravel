<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class DashboardCarController extends Controller
{
    public function index()  {
        $cars = Car::paginate(10);

        return view('dashboard-cars.index', compact('cars'));
    }

    

    public function destroy () {
        return 'gg';
    }
}
