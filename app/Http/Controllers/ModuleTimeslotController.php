<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeslotRequest;
use App\Models\Module;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Module $module, TimeslotRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $conflict = $this->checkConflict($module, $validated);

        if ($conflict->isNotEmpty()) {
            throw ValidationException::withMessages(
                ['clashes' => $conflict]
            );
        }

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
    public function update(TimeslotRequest $request, Module $module, Timeslot $timeslot): RedirectResponse
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
        //Proceed with setting attributes
        $timeslot->setAttribute('module_id', $module->__get('id'));
        $timeslot->setAttribute('room_id', $validated['room_id']);
        $timeslot->setAttribute('day_of_week', $validated['day_of_week']);
        $timeslot->setAttribute('start_time', $validated['start_time']);
        $timeslot->setAttribute('end_time', $validated['end_time']);
        $timeslot->setAttribute('is_lecture', $request->__get('is_lecture') ? 1 : 0);
    }

    public function checkConflict($module, $validated)
    {
        //Check conflict and reject

//        return Timeslot::where('room_id', '=', $validated['room_id'])
//            ->where('day_of_week', '=', $validated['day_of_week'])
//            ->orWhere('module_id', '=', $module->__get('id'))
//            ->whereNot(function ($query) use ($validated) {
//                $query->where('end_time', '<=', $validated['start_time'])
//                    ->orWhere('start_time', '>=', $validated['end_time']);
//            })
//            ->count();
        return Timeslot::where('room_id', '=', $validated['room_id'])
            ->where('day_of_week', '=', $validated['day_of_week'])
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['end_time'])
                    ->where('end_time', '>', $validated['start_time']);
            })
            ->where('module_id', '=', $module->__get('id'))
            ->get();
    }
}
