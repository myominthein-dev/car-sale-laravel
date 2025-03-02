<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuelTypeRequest;
use App\Http\Requests\UpdateFuelTypeRequest;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FuelType::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        $fuelTypes = $query->paginate(10);
        
        return view('fuel-types.index', compact('fuelTypes'));
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
    public function store(StoreFuelTypeRequest $request)
    {
        FuelType::create($request->validated());
        return redirect()->route('fuel-types.index')->with('success', 'Fuel type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelType $fuelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelType $fuelType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelTypeRequest $request, FuelType $fuelType)
    {
        $fuelType->update($request->validated());
        return redirect()->route('fuel-types.index')->with('success', 'Fuel type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelType $fuelType)
    {
        $fuelType->delete();
        return redirect()->route('fuel-types.index')->with('success', 'Fuel type deleted successfully.');
    }
}
