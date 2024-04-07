<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 1701
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 1700
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 1704
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 1702
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 1703
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 2700
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 2718
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 2702
        ]);
        DB::table('degree_module')->insert([
            'degree_id' => 'CS12',
            'module_id' => 2712
        ]);
    }
}
