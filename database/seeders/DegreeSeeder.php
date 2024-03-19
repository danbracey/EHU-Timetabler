<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Degree::factory()->create([
            'id' => '2W11',
            'friendly_name' => 'MComp (Hons) Computing'
        ]);
        Degree::factory()->create([
            'id' => '8B35',
            'friendly_name' => 'MComp (Hons) Computer Security & Networks'
        ]);
        Degree::factory()->create([
            'id' => 'CM17',
            'friendly_name' => 'Computer Science & Mathematics'
        ]);
        Degree::factory()->create([
            'id' => 'CS12',
            'friendly_name' => 'Computer Science'
        ]);
        Degree::factory()->create([
            'id' => 'G401',
            'friendly_name' => 'Computing'
        ]);
        Degree::factory()->create([
            'id' => 'G600',
            'friendly_name' => 'Computer Engineering'
        ]);
        Degree::factory()->create([
            'id' => 'GH76',
            'friendly_name' => 'Robotics & Artificial Intelligence'
        ]);
        Degree::factory()->create([
            'id' => 'GI11',
            'friendly_name' => 'Data Science'
        ]);
        Degree::factory()->create([
            'id' => 'GN52',
            'friendly_name' => 'Information Technology Management for Business'
        ]);
    }
}
