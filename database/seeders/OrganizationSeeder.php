<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            [
                'name' => 'Segítő Kezek Alapítvány',
                'email' => 'info@segito-kezek.hu',
                'description' => 'Az alapítvány a szociális ellátás javítását célozza meg.',
                'category' => 'Szociális ellátás',
                'phone' => '+36 1 234 5678',
                'address' => 'Budapest, 1051 Nádor u. 4.',
                'website' => 'https://segito-kezek.hu',
                'bank_account' => 'HU12 1234 5678 1234 5678 1234 5678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Közösség Fejlődési Centrum',
                'email' => 'contact@kozosseg-fejlodes.hu',
                'description' => 'Helyi közösségek fejlesztésére és támogatására irányuló szervezet.',
                'category' => 'Közösségfejlesztés',
                'phone' => '+36 1 987 6543',
                'address' => 'Debrecen, 4024 Piac u. 12.',
                'website' => 'https://kozosseg-fejlodes.hu',
                'bank_account' => 'HU87 9876 5432 9876 5432 9876 5432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ifjúsági Mentorálási Program',
                'email' => 'youth@mentoring-program.hu',
                'description' => 'Fiatal tehetségek felfedezésére és fejlesztésére szakosodott szervezet.',
                'category' => 'Oktatás',
                'phone' => '+36 20 555 4444',
                'address' => 'Szeged, 6720 Klauzál tér 1.',
                'website' => 'https://mentoring-program.hu',
                'bank_account' => 'HU56 5555 4444 3333 2222 1111 0000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Egészséges Élet Kezdeménye',
                'email' => 'health@egeszseg-elet.hu',
                'description' => 'Az egészséges és aktív életmód népszerűsítésé az a célunk.',
                'category' => 'Egészség',
                'phone' => '+36 30 777 8888',
                'address' => 'Pécs, 7621 Széchenyi tér 2.',
                'website' => 'https://egeszseg-elet.hu',
                'bank_account' => 'HU34 8888 7777 6666 5555 4444 3333',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fenntartható Jövő Alapítvány',
                'email' => 'sustainability@fenntart-jovo.hu',
                'description' => 'Környezetvédelem és fenntartható fejlődés előmozdítása.',
                'category' => 'Környezetvédelem',
                'phone' => '+36 1 111 2222',
                'address' => 'Győr, 9021 Bem József u. 4.',
                'website' => 'https://fenntart-jovo.hu',
                'bank_account' => 'HU72 1111 2222 3333 4444 5555 6666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('organizations')->insert($organizations);
    }
}
