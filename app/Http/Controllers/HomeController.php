<?php

namespace App\Http\Controllers;

use App\Helpers\TimeslotFunctions;
use App\Models\Student;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $request): View
    {
        if ($request->student_id) {
            $events = [];
            $student = Student::where('id', '=', $request->student_id)->first();

            /** Prepare student's timetable into FullCalendar.io compatible array */
            foreach ($student->degree->modules as $module) {
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
            }

            if ($student) {
                return view('timetable', [
                    'Student' => $student,
                    'events' => $events
                ]);
            } else {
                return view('welcome')->withErrors(['Unable to find student!']);
            }
        } else {
            return view('welcome');
        }
    }
}
