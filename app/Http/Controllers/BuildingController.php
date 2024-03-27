<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('building.index', [
            'Buildings' => Building::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('building.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuildingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $building = new Building();
        $building->setAttribute('friendly_name', $validated['friendly_name']);
        $building->save();

        return redirect(route('building.show', $validated['id']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('building.show', [
            'Building' => Building::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('building.edit', [
            'Building' => Building::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuildingRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $building = Building::where('id', '=', $id)->firstOrFail();
        $building->setAttribute('friendly_name', $validated['friendly_name']);
        $building->update();

        return redirect(route('building.show', $validated['id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $building = Building::find($id);
        $building->rooms()->detach();
        $building->delete();
        return redirect(route('building.index'));
    }
}
