<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory()->create([
            'id' => 12345678,
            'first_name' => 'Joe',
            'last_name' => 'Bloggs',
            'degree_id' => Degree::where('code', '=', 'CS12')->first()->id
        ]);
    }
}
