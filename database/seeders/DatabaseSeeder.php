<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users for testing
        User::factory(9)->create();

        // Call other seeders
        $this->call([
            OrganizationSeeder::class,
            EventSeeder::class,
            EventRegistrationSeeder::class,
            EventFeedbackSeeder::class,
        ]);
    }
}
