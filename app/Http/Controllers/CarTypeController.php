<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarTypeRequest;
use App\Http\Requests\UpdateCarTypeRequest;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CarType::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        $carTypes = $query->paginate(10);
        return view('car-types.index',compact('carTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarTypeRequest $request)
    {
        CarType::create($request->validated());
        return redirect()->route('car-types.index')->with('status', 'Car Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $carType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarType $carType)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        $carType->update($request->validated());
        return redirect()->route('car-types.index')->with('status', 'Car Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarType $carType)
    {
        $carType->delete();
        return redirect()->route('car-types.index')->with('status', 'Car Type deleted successfully');
    }
}
