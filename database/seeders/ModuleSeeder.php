<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::factory()->create([
            'id' => 1701,
            'friendly_name' => 'Computer Systems Architecture and Networks'
        ]);
        Module::factory()->create([
            'id' => 1700,
            'friendly_name' => 'Foundations of Computer Science'
        ]);
        Module::factory()->create([
            'id' => 1704,
            'friendly_name' => 'Professional Practice 1'
        ]);
        Module::factory()->create([
            'id' => 1702,
            'friendly_name' => 'Programming 1'
        ]);
        Module::factory()->create([
            'id' => 1703,
            'friendly_name' => 'Programming 2'
        ]);

        //** Year 2 Modules */
        Module::factory()->create([
            'id' => 2700,
            'friendly_name' => 'Database Systems'
        ]);
        Module::factory()->create([
            'id' => 2718,
            'friendly_name' => 'Introduction to Security'
        ]);
        Module::factory()->create([
            'id' => 2702,
            'friendly_name' => 'Object-Orientated Programming'
        ]);
        Module::factory()->create([
            'id' => 2712,
            'friendly_name' => 'Professional Practice 2'
        ]);
        Module::factory()->create([
            'id' => 2705,
            'friendly_name' => 'Data Analytics'
        ]);
        Module::factory()->create([
            'id' => 2719,
            'friendly_name' => 'Foundations of Robotics & Artificial Intelligence'
        ]);
        Module::factory()->create([
            'id' => 2717,
            'friendly_name' => 'Introduction to Artificial Intelligence and Machine Learning'
        ]);

        //* Year 3 Modules */
        Module::factory()->create([
            'id' => 3159,
            'friendly_name' => 'Professional Portfolio'
        ]);
        Module::factory()->create([
            'id' => 3425,
            'friendly_name' => 'Professional Portfolio'
        ]);
        Module::factory()->create([
            'id' => 3414,
            'friendly_name' => 'Secure Complex Systems'
        ]);
        Module::factory()->create([
            'id' => 3401,
            'friendly_name' => 'Advanced Databases'
        ]);
        Module::factory()->create([
            'id' => 3415,
            'friendly_name' => 'Distributed Systems'
        ]);
        Module::factory()->create([
            'id' => 3421,
            'friendly_name' => 'Embedded Systems'
        ]);
        Module::factory()->create([
            'id' => 3404,
            'friendly_name' => 'Interface Programming'
        ]);
        Module::factory()->create([
            'id' => 3140,
            'friendly_name' => 'Research and Development Project'
        ]);
        Module::factory()->create([
            'id' => 3402,
            'friendly_name' => 'IT Management'
        ]);
    }
}
