<?php

namespace App\Http\Controllers;

use App\Models\Degree;
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
        $validated = $request->validated();

        $module = new Module();
        $module->setAttribute('id', $validated['id']);
        $module->setAttribute('friendly_name', $validated['friendly_name']);
        $module->setAttribute('academic_year', $validated['academic_year']);
        $module->save();

        return redirect(route('module.show', $validated['id']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('module.show', [
            'Module' => Module::where('id', '=', $id)->firstOrFail()
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
        $module->setAttribute('academic_year', $validated['academic_year']);
        $module->update();

        return redirect(route('module.show', $validated['id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Module::where('id', '=', $id)->delete();
        return redirect(route('module.index'));
    }
}
