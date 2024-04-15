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
            'code' => '2W11',
            'friendly_name' => 'MComp (Hons) Computing',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => '8B35',
            'friendly_name' => 'MComp (Hons) Computer Security & Networks',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'CM17',
            'friendly_name' => 'Computer Science & Mathematics',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'CS12',
            'friendly_name' => 'Computer Science',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'G701',
            'friendly_name' => 'Computing',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'G600',
            'friendly_name' => 'Computer Engineering',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'GH76',
            'friendly_name' => 'Robotics & Artificial Intelligence',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'GI11',
            'friendly_name' => 'Data Science',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'GN52',
            'friendly_name' => 'Information Technology Management for Business',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'H671/2',
            'friendly_name' => 'Intelligent Automation & Robotics',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'I1I7',
            'friendly_name' => 'Computer Science & Artificial Intelligence',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'I290',
            'friendly_name' => 'Computing (Networking, Security and Forensics)',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'I610',
            'friendly_name' => 'Computing (Games Programming)',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'II33',
            'friendly_name' => 'Software Engineering',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'W7D7',
            'friendly_name' => 'Web Design and Development',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'MsC BDA',
            'friendly_name' => 'Web Design, Development and Analytics',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'MsC Comp',
            'friendly_name' => 'MSc Computing',
            'graduation_year' => 2024
        ]);
        Degree::factory()->create([
            'code' => 'Msc CyberSec',
            'friendly_name' => 'MSc Cyber Security',
            'graduation_year' => 2024
        ]);
    }
}
