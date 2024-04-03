<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeslot>
 */
class TimeslotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        if (!DB::table('modules')->first()) {
            Module::factory()->createOne();
        }

        if (!DB::table('rooms')->first()) {
            Room::factory()->createOne();
        }

        return [
            'module_id' => Module::all()->random()->__get('id'),
            'room_id' => Room::all()->random()->__get('id'),
            'day_of_week' => rand(0, 6),
            'start_time' => time(),
            'end_time' => time() + 1,
            'is_lecture' => rand(-1, 2) //Boolean, between 0 and 1.
        ];
    }
}
