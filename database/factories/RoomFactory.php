<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Degree;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        if (!DB::table('buildings')->first()) {
            Building::factory()->createOne();
        }

        return [
            'id' => Str::random(10),
            'available_seats' => rand(0, 31),
            'available_computers' => rand(0, 31),
            'is_lecture_hall' => false,
            'building' => Building::all()->random()->__get('id')
        ];
    }
}
