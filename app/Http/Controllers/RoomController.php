<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Http\Requests\RoomRequest;
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
    public function create(Building $building): View
    {
        return view('estates.room.create', [
            'Building' => Building::find($building)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Building $building, RoomRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $room = new Room();
        $room->setAttribute('id', $validated['id']);
        $room->setAttribute('available_seats', $validated['available_seats']);
        $room->setAttribute('available_computers', $validated['available_computers']);
        $room->setAttribute('is_lecture_hall', $validated['is_lecture_hall'] ?? false);
        $room->setAttribute('building', $building->__get('id'));
        $room->save();

        return redirect(route('building.show', $building->__get('id')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building, Room $room): \Illuminate\View\View
    {
        $events = [];
        foreach ($room->timeslots as $timeslot) {
            $events[] = [
                'id' => $timeslot->id,
                'title' => "CIS" . $timeslot->module_id . " (Rm: " . $timeslot->room_id . ")",
                'startTime' => $timeslot->start_time,
                'endTime' => $timeslot->end_time,
                'daysOfWeek' => [$timeslot->day_of_week],
                'allDay' => false,
            ];
        }

        return view('estates.room.show', [
            'Building' => $building,
            'Room' => $room,
            'timeslots' => $events
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building, Room $room): View
    {
        return view('estates.room.edit', [
            'Building' => $building,
            'Buildings' => Building::all(),
            'Room' => Room::where('id', '=', $room->id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Building $building, Room $room): RedirectResponse
    {
        Validator::make((array)$request, [
            'id' => [
                Rule::unique('rooms')->ignore($room->__get('id')),
            ],
        ]);

        $validated = $request->validated();

        $room = Room::where('id', '=', $room->id)->where('building', '=', $building->id)->firstOrFail();
        $room->setAttribute('id', $validated['id']);
        $room->setAttribute('available_seats', $validated['available_seats']);
        $room->setAttribute('available_computers', $validated['available_computers']);
        $room->setAttribute('is_lecture_hall', true);
        if (isset($validated['is_lecture_hall'])) {
            $room->setAttribute('is_lecture_hall', true);
        } else {
            $room->setAttribute('is_lecture_hall', false);
        }

        $room->update();

        return redirect(route('building.show', $building));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building, Room $room): RedirectResponse
    {
        $room = Room::where('id', '=', $room->__get('id'))->firstOrFail();
        $room->delete();
        return redirect(route('building.index'));
    }
}
