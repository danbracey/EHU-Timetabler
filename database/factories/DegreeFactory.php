<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Degree>
 */
class DegreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(1) . rand(0, 9) . Str::random(1) . rand(0, 9),
            'friendly_name' => Str::random(10),
            'graduation_year' => 2024
        ];
    }
}
