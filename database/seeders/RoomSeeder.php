<?php

namespace Database\Seeders;

use AllowDynamicProperties;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

#[AllowDynamicProperties] class RoomSeeder extends Seeder
{
    public function __construct()
    {
        $this->building = Building::where('friendly_name', '=', 'Tech Hub')->first();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::factory()->create([
            'id' => 'THF01',
            'available_seats' => 42,
            'available_computers' => 42,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THF02',
            'available_seats' => 30,
            'available_computers' => 30,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THF03',
            'available_seats' => 30,
            'available_computers' => 30,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THF04',
            'available_seats' => 29,
            'available_computers' => 29,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THF05',
            'available_seats' => 24,
            'available_computers' => 24,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THG06',
            'available_seats' => 12,
            'available_computers' => 12,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THG07',
            'available_seats' => 42,
            'available_computers' => 42,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THG08',
            'available_seats' => 60,
            'available_computers' => 0,
            'is_lecture_hall' => 1,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THG05',
            'available_seats' => 30,
            'available_computers' => 30,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THF04 Net link',
            'available_seats' => 18,
            'available_computers' => 18,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
        Room::factory()->create([
            'id' => 'THG01',
            'available_seats' => 30,
            'available_computers' => 30,
            'is_lecture_hall' => 0,
            'building' => $this->building->id
        ]);
    }
}
