<?php

namespace App\Helpers;

use App\Jobs\GenerateTimetable;
use App\Models\Degree;
use App\Models\Timeslot;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Time;

class TimeslotFunctions
{
    public static function parseDay($day): string
    {
        return match ($day) {
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            //The following are not required for the timetable application,
            // but can be useful should the application be expanded.
            6 => "Saturday",
            7 => "Sunday",
            default => "Unknown",
        };
    }

    public static function getNextTimeslot($timeslots): mixed
    {
        // Get current day of the week and time
        $current_day = date('N');
        $current_time = date('H:i');

        // Find the next timeslot
        $next_timeslot = null;
        foreach ($timeslots as $slot) {
            if ($slot->day_of_week == $current_day && $slot->start_time > $current_time) {
                $next_timeslot = $slot;
                break;
            } elseif ($slot->day_of_week > $current_day) {
                $next_timeslot = $slot;
                break;
            } elseif ($slot["day_of_week"] < $current_day) {
                if ($next_timeslot === null || $slot["day_of_week"] > $next_timeslot["day_of_week"]) {
                    $next_timeslot = $slot;
                }
            }
        }

        return $next_timeslot;
    }

    public static function checkConflict($module, $validated)
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
            ->orWhere('module_id', '=', $module->__get('id'))
            ->get();
    }

    public static function generateTimetable(): void
    {
        try {
            GenerateTimetable::dispatch();
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
