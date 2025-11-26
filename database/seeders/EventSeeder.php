<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'organization_id' => 1,
                'title' => 'Adománygyűjtés a rászorulók számára',
                'description' => 'Közös adománygyűjtés a szociálisan hátrányos helyzetű családok megsegítésére.',
                'location' => 'Budapest, Városliget',
                'date' => now()->addDays(7)->setHour(10)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 1,
                'title' => 'Mentális egészség workshop',
                'description' => 'Interaktív workshop a mentális egészség és wellbeing témájában.',
                'location' => 'Budapest, Erkel Szálló',
                'date' => now()->addDays(14)->setHour(14)->setMinute(30),
                'status' => 'Függőben',
                'capacity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2,
                'title' => 'Közösségi nap a városban',
                'description' => 'Szórakoztató és informatív közösségi rendezvény a helyi közösség erősítésére.',
                'location' => 'Debrecen, Nagyerdő',
                'date' => now()->addDays(10)->setHour(11)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2,
                'title' => 'Önkéntes kiképzés',
                'description' => 'Alapvető képzés az önkéntesek számára, hogy hatékonyan tudjanak segíteni.',
                'location' => 'Debrecen, Önkéntes Központ',
                'date' => now()->addDays(21)->setHour(9)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 3,
                'title' => 'Fiatalok karrierfóruma',
                'description' => 'Pályaválasztási tanácsadás és karrierépítési tippek fiatalok számára.',
                'location' => 'Szeged, Szegedi Tudományegyetem',
                'date' => now()->addDays(8)->setHour(15)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 3,
                'title' => 'Mentorálási program záróeseménye',
                'description' => 'A mentorálási program végeredménye és az elért sikerek bemutatása.',
                'location' => 'Szeged, Móra Ferenc Könyvtár',
                'date' => now()->addDays(28)->setHour(18)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 4,
                'title' => 'Futóversenyen keresztül a jó egészségért',
                'description' => 'Szórakoztató futóverseny az egészséges életmód népszerűsítésére.',
                'location' => 'Pécs, Mecsek alja',
                'date' => now()->addDays(12)->setHour(8)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 4,
                'title' => 'Fitness és nutrició előadás',
                'description' => 'Szakértő előadás az egészséges táplálkozásról és fitnesz trendekről.',
                'location' => 'Pécs, Egészség Központ',
                'date' => now()->addDays(5)->setHour(17)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 5,
                'title' => 'Fenntartható célok megvalósításáért szeminár',
                'description' => 'Tudnivalók a fenntartható fejlődési célokról és azok megvalósításáról.',
                'location' => 'Győr, Városi Könyvtár',
                'date' => now()->addDays(15)->setHour(10)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 5,
                'title' => 'Zöld akció nap',
                'description' => 'Közös sétálás és környezetvédelmi tevékenységek a természet védelméért.',
                'location' => 'Győr, Rábapark',
                'date' => now()->addDays(20)->setHour(9)->setMinute(0),
                'status' => 'Függőben',
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('events')->insert($events);
    }
}
