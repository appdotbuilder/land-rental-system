<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;
use App\Models\Land;
use Inertia\Inertia;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lands = Land::with(['rentalContracts.tenant'])
            ->latest()
            ->paginate(10);
        
        return Inertia::render('lands/index', [
            'lands' => $lands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('lands/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLandRequest $request)
    {
        $land = Land::create($request->validated());

        return redirect()->route('lands.show', $land)
            ->with('success', 'Land created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Land $land)
    {
        $land->load(['rentalContracts.tenant', 'expenses']);
        
        return Inertia::render('lands/show', [
            'land' => $land
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land $land)
    {
        return Inertia::render('lands/edit', [
            'land' => $land
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandRequest $request, Land $land)
    {
        $land->update($request->validated());

        return redirect()->route('lands.show', $land)
            ->with('success', 'Land updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land $land)
    {
        $land->delete();

        return redirect()->route('lands.index')
            ->with('success', 'Land deleted successfully.');
    }
}