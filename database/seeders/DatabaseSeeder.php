<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default user for testing
        User::factory()->create([
            'name' => 'Khairul',
            'email' => 'info@khairulimran.com',
            'password' => bcrypt('info@khairulimran.com')
        ]);

        User::factory()->create([
            'name' => 'Madihah',
            'email' => 'madihah@example.com',
            'password' => bcrypt('password')
        ]);

        // Seed wedding data
        $this->call([
            WeddingTasksSeeder::class,
        ]);
    }
}
