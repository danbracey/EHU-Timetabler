<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    // No index for rooms

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('estates.room.create', [
            'Buildings' => Building::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $room = new Room();
        $room->setAttribute('id', $validated['id']);
        $room->setAttribute('available_seats', $validated['available_seats']);
        $room->setAttribute('available_computers', $validated['available_computers']);
        $room->setAttribute('is_lecture_hall', $validated['is_lecture_hall']);
        $room->save();

        return redirect(route('room.show', [$room->__get('building'), $room->__get('id')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building, Room $room): View
    {
        return view('estates.room.show', [
            'Room' => Room::where('id', '=', $room)->where('building', '=', $building)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building, Room $room): View
    {
        return view('estates.room.edit', [
            'Room' => Room::where('id', '=', $room)->where('building', '=', $building)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Building $building, Room $room): RedirectResponse
    {
        Validator::make((array)$request, [
            'id' => [
                Rule::unique('rooms')->ignore($room),
            ],
        ]);

        $validated = $request->validated();

        $room = Room::where('id', '=', $room)->where('building', '=', $building)->firstOrFail();
        $room->setAttribute('id', $validated['id']);
        $room->setAttribute('available_seats', $validated['available_seats']);
        $room->setAttribute('available_computers', $validated['available_computers']);
        $room->setAttribute('is_lecture_hall', $validated['is_lecture_hall']);
        $room->update();

        return redirect(route('room.show', [$building, $room->__get('id')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $room = Room::find($id);
        $room->getBuilding()->detach();
        $room->delete();
        return redirect(route('buildings.index'));
    }
}
