<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->student_id) {
            $student = Student::where('id', '=', $request->student_id)->first();

            if ($student) {
                return view('timetable', [
                    'Student' => $student
                ]);
            } else {
                return view('welcome')->withErrors(['Unable to find student!']);
            }
        } else {
            return view('welcome');
        }
    }
}
