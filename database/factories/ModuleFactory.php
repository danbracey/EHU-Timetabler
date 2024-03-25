<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Generate academic year
        $academicYear = rand(20, 29);

        return [
            'id' => rand(1000, 3999),
            'friendly_name' => fake()->realText(),
            'academic_year' => $academicYear . '/' . $academicYear + 1
        ];
    }
}
