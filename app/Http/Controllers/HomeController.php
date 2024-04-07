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
            if (!$student) {
                return view('welcome')->withErrors(['Unable to find student!']);
            }

            /** Prepare student's timetable into FullCalendar.io compatible array */
            foreach ($student->degree->modules as $module) {
                if (substr($module->id, 0, 1) === $student->degree->graduation_year - date("Y")) {
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
            }

            $classesToday = [];
            /** Show student's classes for the day */
            foreach ($student->degree->modules as $module) {
                if (substr($module->id, 0, 1) === $student->degree->graduation_year - date("Y")) {
                    foreach ($module->timeslots as $timeslot) {
                        if ($timeslot->day_of_week == date('N')) {
                            $classesToday[] = $timeslot;
                        }
                    }
                }
            }

            return view('timetable', [
                'Student' => $student,
                'events' => $events,
                'classesToday' => $classesToday
            ]);
        } else {
            return view('welcome');
        }
    }
}
