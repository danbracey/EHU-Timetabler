<?php

namespace App\Http\Controllers;

use App\Http\Requests\DegreeRequest;
use App\Models\Degree;
use App\Models\Module;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('degree.index', [
            'Degrees' => Degree::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('degree.create', [
            'Modules' => Module::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $degree = new Degree();
        $degree->setAttribute('code', $validated['code']);
        $degree->setAttribute('friendly_name', $validated['friendly_name']);
        $degree->setAttribute('graduation_year', $validated['graduation_year']);
        $degree->save();
        $degree->modules()->sync($validated['modules']);

        return redirect(route('degree.show', $degree->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('degree.show', [
            'Degree' => Degree::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('degree.edit', [
            'Degree' => Degree::where('id', '=', $id)->firstOrFail(),
            'Modules' => Module::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $degree = Degree::where('id', '=', $id)->firstOrFail();
        $degree->setAttribute('code', $validated['code']);
        $degree->setAttribute('friendly_name', $validated['friendly_name']);
        $degree->setAttribute('graduation_year', $validated['graduation_year']);
        $degree->modules()->sync($validated['modules']);
        $degree->update();

        return redirect(route('degree.show', $degree->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $degree = Degree::find($id);
        $degree->modules()->detach();
        $degree->delete();
        return redirect(route('degree.index'));

        //TODO: Call service to automatically regen timetable
    }
}
