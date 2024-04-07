<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::factory()->create([
            'name' => 'Academic',
            'email' => '24969761@edgehill.ac.uk',
            'password' => Hash::make('password')
        ]);

        $this->call([
            DegreeSeeder::class,
            StudentSeeder::class,
            ModuleSeeder::class,
            DegreeModuleSeeder::class
        ]);
    }
}
