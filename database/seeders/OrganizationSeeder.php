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
        $allowedCategories = [
            'Szociális és humanitárius szervezetek',
            'Egészségügyi szervezetek',
            'Oktatási és tudományos szervezetek',
            'Környezetvédelmi szervezetek',
            'Emberi jogi és jogvédő szervezetek',
            'Kulturális és művészeti szervezetek',
            'Sport és szabadidős szervezetek',
            'Ifjúsági és közösségfejlesztő szervezetek',
            'Érdekvédelmi és szakmai szervezetek',
        ];

        $organizations = [
            [
                'name' => 'Segítő Kezek Alapítvány',
                'email' => 'info@segito-kezek.hu',
                'description' => 'Az alapítvány a szociális ellátás javítását célozza meg.',
                'category' => $allowedCategories[0],
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
                'category' => $allowedCategories[7],
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
                'category' => $allowedCategories[2],
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
                'category' => $allowedCategories[1],
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
                'category' => $allowedCategories[3],
                'phone' => '+36 1 111 2222',
                'address' => 'Győr, 9021 Bem József u. 4.',
                'website' => 'https://fenntart-jovo.hu',
                'bank_account' => 'HU72 1111 2222 3333 4444 5555 6666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jogainkért Egyesület',
                'email' => 'hello@jogainkert.hu',
                'description' => 'Jogsegély és jogtudatossági programok rászorulóknak.',
                'category' => $allowedCategories[4],
                'phone' => '+36 30 222 1100',
                'address' => 'Budapest, 1085 József krt. 12.',
                'website' => 'https://jogainkert.hu',
                'bank_account' => 'HU10 1000 2000 3000 4000 5000 6000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Városi Kulturális Műhely',
                'email' => 'info@varosimuhely.hu',
                'description' => 'Közösségi alkotóműhely, kiállítások és művészeti foglalkozások.',
                'category' => $allowedCategories[5],
                'phone' => '+36 20 333 2211',
                'address' => 'Szentendre, 2000 Fő tér 3.',
                'website' => 'https://varosimuhely.hu',
                'bank_account' => 'HU20 1111 2222 3333 4444 5555 6666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mozgásban a Város Sportklub',
                'email' => 'kapcsolat@mozgasbanavaros.hu',
                'description' => 'Közösségi sportprogramok és szabadidős események szervezése.',
                'category' => $allowedCategories[6],
                'phone' => '+36 70 444 5566',
                'address' => 'Sopron, 9400 Deák tér 5.',
                'website' => 'https://mozgasbanavaros.hu',
                'bank_account' => 'HU30 2222 3333 4444 5555 6666 7777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szakmai Kerekasztal Szövetség',
                'email' => 'iroda@szakmaikerekasztal.hu',
                'description' => 'Szakmai együttműködés, érdekképviselet és konferenciák szervezése.',
                'category' => $allowedCategories[8],
                'phone' => '+36 1 555 0000',
                'address' => 'Budapest, 1137 Szent István krt. 8.',
                'website' => 'https://szakmaikerekasztal.hu',
                'bank_account' => 'HU40 3333 4444 5555 6666 7777 8888',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('organizations')->insert($organizations);
    }
}
