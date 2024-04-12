<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\Degree;
use App\Models\Module;
use App\Models\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('module.index', [
            'Modules' => Module::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('module.create', [
            'Degrees' => Degree::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuleRequest $request): RedirectResponse
    {
        Validator::make((array)$request, [
            'id' => [
                Rule::unique('modules'),
            ],
        ]);
        $validated = $request->validated();

        $module = new Module();
        $module->setAttribute('id', $validated['id']);
        $module->setAttribute('friendly_name', $validated['friendly_name']);
        $module->setAttribute('seminars_per_week', $validated['seminars_per_week']);
        $module->setAttribute('lectures_per_week', $validated['lectures_per_week']);
        $module->save();
        $module->degrees()->sync($validated['degrees']);

        return redirect(route('module.show', $validated['id']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module): View
    {
        $events = [];
        foreach ($module->timeslots as $timeslot) {
            $events[] = [
                'id' => $timeslot->id,
                'title' => "CIS" . $timeslot->module_id . " (Rm: " . $timeslot->room_id . ")",
                'startTime' => $timeslot->start_time,
                'endTime' => $timeslot->end_time,
                'daysOfWeek' => [$timeslot->day_of_week],
                'allDay' => false,
            ];
        }

        return view('module.show', [
            'Module' => $module,
            'timeslots' => $events
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('module.edit', [
            'Module' => Module::where('id', '=', $id)->firstOrFail(),
            'Degrees' => Degree::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuleRequest $request, string $id)
    {
        Validator::make((array)$request, [
            'id' => [
                Rule::unique('modules')->ignore($id),
            ],
        ]);

        $validated = $request->validated();

        $module = Module::where('id', '=', $id)->firstOrFail();
        $module->setAttribute('id', $validated['id']);
        $module->setAttribute('friendly_name', $validated['friendly_name']);
        $module->setAttribute('seminars_per_week', $validated['seminars_per_week']);
        $module->setAttribute('lectures_per_week', $validated['lectures_per_week']);
        $module->degrees()->sync($validated['degrees']);
        $module->update();

        return redirect(route('module.show', $validated['id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module = Module::find($id);
        $module->degrees()->detach();
        $module->delete();
        return redirect(route('module.index'));
    }
}
