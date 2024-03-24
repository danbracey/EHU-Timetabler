<?php

namespace Database\Factories;

use App\Models\Degree;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        if (!DB::table('degrees')->first()) {
            Degree::factory()->createOne();
        }

        return [
            'id' => rand(10000000, 99999999),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'degree_id' => Degree::all()->random()->__get('id')
        ];
    }
}
