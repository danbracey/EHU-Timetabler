<?php

namespace App\Jobs;

use App\Helpers\TimeslotFunctions;
use App\Models\Degree;
use App\Models\Module;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class GenerateTimetable implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        info('Starting automatic timetable generation');
        $degrees = Degree::all();

        //Truncate all timetabling information and start afresh
        Timeslot::truncate();

        foreach ($degrees as $degree) {
            $modules = $degree->modules;

            foreach ($modules as $module) {
                //Check if module has been fully assigned timeslots
                $module_timeslots = Timeslot::where('module_id', '=', $module->id);
                if ($module->lectures_per_week + $module->seminars_per_week > $module_timeslots->count()) {
                    //Handle lectures first
                    for ($i = 0; $i < $module->lectures_per_week; $i++) {
                        $this->assignTimeslot($module, true, $degree);
                    }

                    //Handle seminars
                    for ($i = 0; $i < $module->seminars_per_week; $i++) {
                        $this->assignTimeslot($module, false, $degree);
                    }
                } else {
                    dd("got here");
                }
            }
        }
    }

    private function assignTimeslot(mixed $module, bool $is_lecture, Degree $degree)
    {
        $roomStack = Room::where('is_lecture_hall', '=', $is_lecture ? 1 : 0)
            ->where('available_seats', '>', $degree->students->count())
            ->get();

        if (! $roomStack) {
            abort(500, "No" . $is_lecture ? "lecture" : "seminar" . " rooms left in stack!");
        }

        // Order rooms by Tech Hub
        /** Soft requirement, come back to this - For now we don't care where the assigned rooms are. */

//        for ($day = 1; $day < 6; $day++) { //Between Mon - Friday
//            for ($i = 9; $i < 17; $i++) { //Between 9am and 5pm
//
//            }
//        }

        //dd($module);

        $day = rand(1, 5);
        $time = rand(9, 16);

        $conflict = TimeslotFunctions::checkConflict($module, [
            'room_id' => $roomStack->first()->id, //Taking the first element from the stack
            'day_of_week' => $day,
            'start_time' => $time . ':00:00',
            'end_time' => $time + 1 . ':00:00',
            'module_id' => $module->id
        ]);

        if (isEmpty($conflict)) {
            $timeslot = new Timeslot();
            $timeslot->module_id = $module->id;
            $timeslot->room_id = $roomStack->first()->id;
            $timeslot->day_of_week = $day;
            $timeslot->start_time = $time . ':00:00';
            $timeslot->end_time = $time + 1 . ':00:00';
            $timeslot->is_lecture = $is_lecture;
            $timeslot->save();

            //Remove first element in room stack
            $roomStack->forget($roomStack->first()->id);
        }
    }
}
