<?php

namespace App\Jobs;

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
                if ($module->lectures_per_week + $module->seminars_per_week < $module_timeslots->count()) {
                    //Handle lectures first
                    for ($i = 0; $i > $module->lectures_per_week; $i++) {
                        $this->assignTimeslot($module, true);
                    }
                }
            }
        }
    }

    private function assignTimeslot(mixed $module, bool $is_lecture)
    {
        $roomStack = Room::where('is_lecture_hall', '=', $is_lecture)->get();
        //TODO: look @ algorithm flow on Miro
    }
}
