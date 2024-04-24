<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the student.
     */
    public function index(): View
    {
        return view('student.index', [
            'Students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new student.
     */
    public function create(): View
    {
        return view('student.create', [
            'Degrees' => Degree::all()
        ]);
    }

    /**
     * Store a newly created student.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $student = new Student();
        $student->setAttribute('id', $validated['id']);
        $student->setAttribute('first_name', $validated['first_name']);
        $student->setAttribute('last_name', $validated['last_name']);
        $student->setAttribute('degree_id', $validated['degree']);
        $student->save();

        return redirect(route('student.show', $validated['id']));
    }

    /**
     * Display the specified student.
     */
    public function show(string $id): View
    {
        return view('student.show', [
            'Student' => Student::where('id', '=', $id)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(string $id): View
    {
        return view('student.edit', [
            'Student' => Student::where('id', '=', $id)->firstOrFail(),
            'Degrees' => Degree::all()
        ]);
    }

    /**
     * Update the specified student.
     */
    public function update(StudentRequest $request, string $id): RedirectResponse
    {
        Validator::make((array)$request, [
            'id' => [
                Rule::unique('students')->ignore($id),
            ],
        ]);

        $validated = $request->validated();

        $student = Student::where('id', '=', $id)->firstOrFail();
        $student->setAttribute('id', $validated['id']);
        $student->setAttribute('first_name', $validated['first_name']);
        $student->setAttribute('last_name', $validated['last_name']);
        $student->setAttribute('degree_id', $validated['degree']);
        $student->update();

        return redirect(route('student.show', $validated['id']));
    }

    /**
     * Remove the specified student.
     */
    public function destroy(string $id): RedirectResponse
    {
        Student::where('id', '=', $id)->delete();
        return redirect(route('student.index'));
    }
}
