<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display all buildings
     */
    public function index(): View
    {
        return view('estates.building.index', [
            'Buildings' => Building::all()
        ]);
    }

    /**
     * Show the form for creating a new building.
     */
    public function create(): View
    {
        return view('estates.building.create');
    }

    /**
     * Store a newly created building in storage.
     */
    public function store(BuildingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $building = new Building();
        $building->setAttribute('friendly_name', $validated['friendly_name']);
        $building->save();

        return redirect(route('building.show', $building->__get('id')));
    }

    /**
     * Display the specified building.
     */
    public function show(string $id): View
    {
        return view('estates.building.show', [
            'Building' => Building::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified building.
     */
    public function edit(string $id): View
    {
        return view('estates.building.edit', [
            'Building' => Building::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified building
     */
    public function update(BuildingRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $building = Building::where('id', '=', $id)->firstOrFail();
        $building->setAttribute('friendly_name', $validated['friendly_name']);
        $building->update();

        return redirect(route('building.show', $building->__get('id')));
    }

    /**
     * Delete the specified building
     */
    public function destroy(string $id): RedirectResponse
    {
        $building = Building::where('id', '=', $id)->firstOrFail();
        //Delete all rooms attached to this building
        Room::where('building', '=', $building->id)->delete();
        $building->delete();
        return redirect(route('building.index'));
    }
}
