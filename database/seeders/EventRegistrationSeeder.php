<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = [
            // User 1 registrations
            [
                'user_id' => 1,
                'event_id' => 1,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'event_id' => 3,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 1,
                'event_id' => 5,
                'status' => 'Függőben',
                'registered_at' => now()->subDays(1),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            // Additional users registrations (creating from seeded users via factory)
            [
                'user_id' => 2,
                'event_id' => 2,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'user_id' => 2,
                'event_id' => 4,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 3,
                'event_id' => 1,
                'status' => 'Lemondva',
                'registered_at' => now()->subDays(6),
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'event_id' => 6,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 4,
                'event_id' => 7,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'event_id' => 8,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(1),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 5,
                'event_id' => 9,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'user_id' => 5,
                'event_id' => 10,
                'status' => 'Függőben',
                'registered_at' => now()->subDays(1),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 6,
                'event_id' => 2,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 7,
                'event_id' => 1,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 8,
                'event_id' => 4,
                'status' => 'Elfogadva',
                'registered_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 9,
                'event_id' => 7,
                'status' => 'Lemondva',
                'registered_at' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(2),
            ],
        ];

        DB::table('event_registrations')->insert($registrations);
    }
}
