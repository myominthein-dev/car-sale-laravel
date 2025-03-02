<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMakerRequest;
use App\Http\Requests\UpdateMakerRequest;
use App\Models\Maker;
use Illuminate\Http\Request;

class MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Maker::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $makers = $query->paginate(10);
        
        return view('makers.index', compact('makers'));
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
    public function store(StoreMakerRequest $request)
    {
        Maker::create($request->validated());
        return redirect()->route('makers.index')->with('success', 'Maker created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maker $maker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maker $maker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMakerRequest $request, Maker $maker)
    {
        $maker->update($request->validated());
        return redirect()->route('makers.index')->with('success', 'Maker updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maker $maker)
    {
        $maker->delete();
        return redirect()->route('makers.index')->with('success', 'Maker deleted successfully');
    }
}
