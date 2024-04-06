<?php

namespace App\Helpers;

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
}
