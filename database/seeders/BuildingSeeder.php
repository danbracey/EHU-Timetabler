<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::factory()->create([
            'friendly_name' => 'Tech Hub'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Geo Sciences'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Law & Psychology'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Health'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Education'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Student Hub'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Business'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Main Building'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Wilson (Sports)'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Catalyst'
        ]);
        Building::factory()->create([
            'friendly_name' => 'Creative Edge'
        ]);
    }
}
