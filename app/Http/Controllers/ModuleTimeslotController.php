<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Time;

class ModuleTimeslotController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Module $module): View
    {
        return view('module.timeslot.create', [
            'module' => $module,
            'rooms' => Room::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Module $module, Request $request)
    {
        $validated = $request->validated();

        //TODO: Check conflict and reject if conflict occurs

        $timeslot = new Timeslot();
        $timeslot->setAttribute('module_id', $module->__get('id'));
        $timeslot->setAttribute('room_id', $validated['room_id']);
        $timeslot->setAttribute('day_of_week', $validated['day_of_week']);
        $timeslot->setAttribute('start_time', $validated['start_time']);
        $timeslot->setAttribute('end_time', $validated['end_time']);
        $timeslot->setAttribute('is_lecture', $validated['is_lecture']);
        $timeslot->save();

        return redirect(route('module.show', $module->__get('id')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module, Timeslot $timeslot): View
    {
        return view('module.timeslot.edit', [
            'module' => $module,
            'timeslot' => $timeslot
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module, Timeslot $timeslot)
    {
        $validated = $request->validated();

        $timeslot->setAttribute('module_id', $timeslot->__get('id'));
        $timeslot->setAttribute('room_id', $validated['room_id']);
        $timeslot->setAttribute('day_of_week', $validated['day_of_week']);
        $timeslot->setAttribute('start_time', $validated['start_time']);
        $timeslot->setAttribute('end_time', $validated['end_time']);
        $timeslot->setAttribute('is_lecture', $validated['is_lecture']);
        $timeslot->update();

        return redirect(route('module.show', $module));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module, Timeslot $timeslot): RedirectResponse
    {
        $timeslot->delete();

        return redirect(route('module.show', $module));
    }
}
