<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarModelRequest;
use App\Http\Requests\UpdateCarModelRequest;
use App\Models\CarModel;
use App\Models\Maker;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $makers = Maker::all();
        $query = CarModel::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
       
        $carModels = $query->paginate(10);
        
        return view('car-models.index', compact('carModels', 'makers'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::all();
        return view('car-models.create', compact('makers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelRequest $request)
    {
        $validated = $request->validated();
        CarModel::create(['name' => $validated['name'], 'maker_id' => $validated['maker']]);
        return redirect()->route('models.index')->with('success', 'Car Model created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        return view('car-models.show', compact('carModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarModel $carModel)
    {
        $makers = Maker::all();
        return view('car-models.edit', compact('carModel', 'makers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarModelRequest $request, CarModel $model)
    {
        $validated = $request->validated();
        $model->update(['name' => $validated['name'], 'maker_id' => $validated['maker']]);
        return redirect()->route('models.index')->with('success', 'Car Model updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $model)
    {
        if ($model->cars()->exists()) {
            return redirect()->route('models.index')->with('error', 'Car Model cannot be deleted because it has cars');
        }
        
        $model->delete();
        return redirect()->route('models.index')->with('success', 'Car Model deleted successfully');
    }
}
