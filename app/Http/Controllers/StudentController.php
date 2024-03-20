<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('student.index', [
            'Students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $student = new Student();
        $student->setAttribute('first_name', $validated['first_name']);
        $student->setAttribute('last_name', $validated['last_name']);
        $student->setAttribute('degree', $validated['degree']);
        $student->save();

        return redirect(route('student.show', $validated['id']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('student.show', [
            'Student' => Student::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('degree.edit', [
            'Student' => Student::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $student = Student::where('id', '=', $id)->firstOrFail();
        $student->setAttribute('first_name', $validated['first_name']);
        $student->setAttribute('last_name', $validated['last_name']);
        $student->setAttribute('degree', $validated['degree']);
        $student->update();

        return redirect(route('degree.show', $validated['id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Student::where('id', '=', $id)->delete();
        return redirect(route('student.index'));
    }
}
