<?php

namespace Database\Seeders;

use App\Jobs\GenerateTimetable;
use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('module_timeslot')->insert([
            [
                'module_id' => 1700,
                'room_id' => 'THG08',
                'day_of_week' => 3,
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 1701,
                'room_id' => 'THG08',
                'day_of_week' => 3,
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'is_lecture' => 1
            ]
        ]);
        DB::table('module_timeslot')->insert([
            [
                'module_id' => 1702,
                'room_id' => 'THG08',
                'day_of_week' => 5,
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 1703,
                'room_id' => 'THG08',
                'day_of_week' => 1,
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'is_lecture' => 1
            ]
        ]);
        DB::table('module_timeslot')->insert([
            [
                'module_id' => 1704,
                'room_id' => 'THG08',
                'day_of_week' => 2,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 2700,
                'room_id' => 'THG08',
                'day_of_week' => 1,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'is_lecture' => 1
            ]
        ]);
        DB::table('module_timeslot')->insert([
            [
                'module_id' => 2702,
                'room_id' => 'THG08',
                'day_of_week' => 5,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 2712,
                'room_id' => 'THG08',
                'day_of_week' => 2,
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 2718,
                'room_id' => 'THG08',
                'day_of_week' => 1,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3401,
                'room_id' => 'THF01',
                'day_of_week' => 1,
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'is_lecture' => 0
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3401,
                'room_id' => 'THF01',
                'day_of_week' => 1,
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3159,
                'room_id' => 'THG07',
                'day_of_week' => 2,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'is_lecture' => 0
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3159,
                'room_id' => 'THG08',
                'day_of_week' => 2,
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'is_lecture' => 1
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3415,
                'room_id' => 'THF05',
                'day_of_week' => 4,
                'start_time' => '13:00:00',
                'end_time' => '14:00:00',
                'is_lecture' => 0
            ]
        ]);

        DB::table('module_timeslot')->insert([
            [
                'module_id' => 3415,
                'room_id' => 'THG08',
                'day_of_week' => 4,
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'is_lecture' => 1
            ]
        ]);
    }
}
