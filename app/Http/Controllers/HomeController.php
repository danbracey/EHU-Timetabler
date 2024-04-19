<?php

namespace App\Http\Controllers;

use App\Helpers\TimeslotFunctions;
use App\Models\Module;
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
            $classesToday = [];
            $student = Student::where('id', '=', $request->student_id)->first();
            if (!$student) {
                return view('welcome')->withErrors(['Unable to find student!']);
            }

            /** Prepare student's timetable into FullCalendar.io compatible array */
            foreach ($student->degree->modules as $module) {
                $module_year = $student->degree->graduation_year - date("Y");

                switch ($module_year) {
                    case 0:
                        foreach ($module->timeslots as $timeslot) {
                            if ((int) substr($module->id, 0, 1) === 3) {
                                $this->handleTimeslot($timeslot, $classesToday, $events);
                            }
                        }
                        break;
                    case 1:
                        foreach ($module->timeslots as $timeslot) {
                            if (substr($module->id, 0, 1) == 2) {
                                $this->handleTimeslot($timeslot, $classesToday, $events);
                            }
                        }
                        break;
                    case 2:
                        foreach ($module->timeslots as $timeslot) {
                            if (substr($module->id, 0, 1) == 1) {
                                $this->handleTimeslot($timeslot, $classesToday, $events);
                            }
                        }
                        break;
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

    public function dashboard(): View
    {
        $modules = Module::all();
        $events = [];
        foreach ($modules as $module) {
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

        return view('dashboard', [
            'timeslots' => $events,
        ]);
    }

    private function handleTimeslot($timeslot, &$classesToday, &$events): void
    {
        if ($timeslot->day_of_week == date('N')) {
            $classesToday[] = $timeslot;
        }

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
