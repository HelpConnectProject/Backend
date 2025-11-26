<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'user_id' => 1,
                'organization_id' => 1,
                'event_id' => 1,
                'rating' => 5,
                'comment' => 'Fantasztikus rendezvény volt! A szervezők nagyon profi voltak, és az egész nap jól szervezett volt.',
                'image' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 1,
                'organization_id' => 2,
                'event_id' => 3,
                'rating' => 4,
                'comment' => 'Nagyon jól éreztük magunkat. A közösség rendezvény tényleg összehoztad az embereket.',
                'image' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 2,
                'organization_id' => 1,
                'event_id' => 2,
                'rating' => 5,
                'comment' => 'A workshop nagyon informatív volt. A vezetők szakterületükön valóban járatosak.',
                'image' => null,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'user_id' => 3,
                'organization_id' => 3,
                'event_id' => 6,
                'rating' => 4,
                'comment' => 'Remek rendezvény, sok hasznos tippet kaptam a jövőmre vonatkozóan.',
                'image' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 4,
                'organization_id' => 4,
                'event_id' => 7,
                'rating' => 5,
                'comment' => 'Szuper futóverseny volt! Az egész szervezés hibátlan, és a hangulat is nagyon jó volt.',
                'image' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'organization_id' => 4,
                'event_id' => 8,
                'rating' => 4,
                'comment' => 'Hasznos információ a táplálkozásról. Az előadó nagyon szimpatikus volt.',
                'image' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 5,
                'organization_id' => 5,
                'event_id' => 9,
                'rating' => 4,
                'comment' => 'A szeminárium nagyon érdekes volt. Sokat megtudtam a fenntartható fejlődésről.',
                'image' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 6,
                'organization_id' => 1,
                'event_id' => 2,
                'rating' => 3,
                'comment' => 'Jó volt az esemény, de túl sok ember volt a helyszínen. Azon kívül mindent jól csináltak.',
                'image' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 7,
                'organization_id' => 1,
                'event_id' => 1,
                'rating' => 5,
                'comment' => 'Kiváló rendezvény! Biztos, hogy legközelebb is részt veszek.',
                'image' => null,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'user_id' => 8,
                'organization_id' => 2,
                'event_id' => 4,
                'rating' => 4,
                'comment' => 'A kiképzés nagyon hasznos volt. Már alig várom, hogy elkezdjem az önkéntes munkámat.',
                'image' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'organization_id' => 5,
                'event_id' => null,
                'rating' => 4,
                'comment' => 'Általában nagyon tetszik ennek a szervezetnek a munkája. Támogatom az értékeiket.',
                'image' => null,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'user_id' => 2,
                'organization_id' => 3,
                'event_id' => null,
                'rating' => 5,
                'comment' => 'Csodálatos szervezet! Sokaknak segítettek már az értékek és programok révén.',
                'image' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
        ];

        DB::table('event_feedbacks')->insert($feedbacks);
    }
}
