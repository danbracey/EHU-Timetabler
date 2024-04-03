<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeslotRequest;
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
            'Module' => $module,
            'Rooms' => Room::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Module $module, TimeslotRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        //TODO: Check conflict and reject if conflict occurs

        $timeslot = new Timeslot();
        $this->setAttributes($timeslot, $module, $validated, $request);
        $timeslot->save();

        return redirect(route('module.show', $module->__get('id')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module, Timeslot $timeslot): View
    {
        return view('module.timeslot.edit', [
            'Module' => $module,
            'Timeslot' => $timeslot,
            'Rooms' => Room::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeslotRequest $request, Module $module, Timeslot $timeslot)
    {
        $validated = $request->validated();

        $this->setAttributes($timeslot, $module, $validated, $request);
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

    /**
     * This method extracts the attribute setting for both create and update to reduce duplication
     *
     * @param Timeslot $timeslot
     * @param Module $module
     * @param $validated
     * @param Request $request
     * @return void
     */
    private function setAttributes(Timeslot $timeslot, Module $module, $validated, Request $request): void
    {
        $timeslot->setAttribute('module_id', $module->__get('id'));
        $timeslot->setAttribute('room_id', $validated['room_id']);
        $timeslot->setAttribute('day_of_week', $validated['day_of_week']);
        $timeslot->setAttribute('start_time', $validated['start_time']);
        $timeslot->setAttribute('end_time', $validated['end_time']);
        $timeslot->setAttribute('is_lecture', $request->__get('is_lecture') ? 1 : 0);
    }
}
