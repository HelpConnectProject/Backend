<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventFeedback;
use App\Models\OrganizationMember;
use App\Models\UserQualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\EventSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Superadmin az első sorban
        $superAdmin = User::create([
            'name' => 'Rendszer Szuperadmin',
            'email' => 'superadmin@helpconnect.hu',
            'email_verified_at' => now(),
            'password' => '123',
            'role' => 'superadmin',
            'status' => 'Aktív',
            'city' => 'Budapest',
            'about' => 'A rendszer globális adminisztrátora.',
            'profile_image' => null,
        ]);


        $users = User::factory(19)->create();

        $allUsers = User::all();


        $interestPool = [
            'környezetvédelem',
            'állatvédelem',
            'gyermekprogramok',
            'sport és futás',
            'idősgondozás',
            'oktatás és korrepetálás',
            'adománygyűjtés',
            'mentális egészség',
            'közösségépítés',
        ];

        $qualificationPool = [
            'érettségi',
            'szociális munkás diploma',
            'pedagógus végzettség',
            'pszichológus',
            'egészségügyi asszisztens',
            'informatikus',
            'alapfokú végzettség',
        ];

        $experiencePool = [
            '2 év önkéntes munka idősek otthonában',
            '3 év tapasztalat adománygyűjtő szervezésben',
            '1 év gyermekfelügyelet és táboroztatás',
            'Évek óta részt vesz közösségi programok szervezésében',
            'Rendszeres részvétel utcai szemétszedésben és faültetésben',
            'Alapítványi adminisztratív feladatok ellátása',
            'Mentorálás fiatalok számára tanulmányi kérdésekben',
        ];

        foreach ($allUsers as $user) {
            // 3 interest
            $pickedInterests = collect($interestPool)->random(3)->values();
            foreach ($pickedInterests as $text) {
                UserQualification::create([
                    'user_id' => $user->id,
                    'interest' => $text,
                ]);
            }

            // 3 qualifications
            $pickedQualifications = collect($qualificationPool)->random(3)->values();
            foreach ($pickedQualifications as $text) {
                UserQualification::create([
                    'user_id' => $user->id,
                    'qualification' => $text,
                ]);
            }

            // 3 experiences
            $pickedExperiences = collect($experiencePool)->random(3)->values();
            foreach ($pickedExperiences as $text) {
                UserQualification::create([
                    'user_id' => $user->id,
                    'experience' => $text,
                ]);
            }
        }


        $allowedOrgCategories = [
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

        $organizationsData = [
            [
                'name' => 'Segítő Kezek Alapítvány',
                'description' => 'Rászoruló családok támogatása és adománygyűjtés.',
                'category' => $allowedOrgCategories[0],
                'phone' => '+36 1 234 5678',
                'address' => 'Budapest, V. kerület, Nádor utca 4.',
                'email' => 'info@segito-kezek.hu',
                'website' => 'https://segito-kezek.hu',
                'bank_account' => 'HU12 1111 2222 3333 4444 5555 6666',
            ],
            [
                'name' => 'Gyógyító Szív Egészségközpont',
                'description' => 'Egészségmegőrző programok, szűrések és tanácsadás.',
                'category' => $allowedOrgCategories[1],
                'phone' => '+36 30 555 1122',
                'address' => 'Debrecen, Piac utca 12.',
                'email' => 'info@gyogyitosziv.hu',
                'website' => 'https://gyogyitosziv.hu',
                'bank_account' => 'HU34 2222 3333 4444 5555 6666 7777',
            ],
            [
                'name' => 'Zöld Jövő Környezetvédelmi Kör',
                'description' => 'Faültetés, szemétszedés, környezeti nevelés.',
                'category' => $allowedOrgCategories[3],
                'phone' => '+36 20 987 6543',
                'address' => 'Szeged, Kossuth Lajos sugárút 5.',
                'email' => 'info@zoldjovo.hu',
                'website' => 'https://zoldjovo.hu',
                'bank_account' => 'HU56 3333 4444 5555 6666 7777 8888',
            ],
            [
                'name' => 'Ifjúsági Mentor Program',
                'description' => 'Fiatalok karrier- és tanulmányi mentorálása.',
                'category' => $allowedOrgCategories[7],
                'phone' => '+36 20 444 5566',
                'address' => 'Pécs, Széchenyi tér 2.',
                'email' => 'info@ifjusagimentor.hu',
                'website' => 'https://ifjusagimentor.hu',
                'bank_account' => 'HU72 4444 5555 6666 7777 8888 9999',
            ],
            [
                'name' => 'Tudás Hídja Oktatási Központ',
                'description' => 'Ingyenes felzárkóztató és nyelvi képzések.',
                'category' => $allowedOrgCategories[2],
                'phone' => '+36 30 999 8877',
                'address' => 'Szombathely, Fő tér 1.',
                'email' => 'info@tudashidja.hu',
                'website' => 'https://tudashidja.hu',
                'bank_account' => 'HU55 0000 1111 2222 3333 4444 5555',
            ],
            [
                'name' => 'Jogainkért Egyesület',
                'description' => 'Jogsegély és jogtudatossági programok rászorulóknak.',
                'category' => $allowedOrgCategories[4],
                'phone' => '+36 1 222 3344',
                'address' => 'Budapest, VIII. kerület, József körút 12.',
                'email' => 'info@jogainkert.hu',
                'website' => 'https://jogainkert.hu',
                'bank_account' => 'HU33 8888 9999 0000 1111 2222 3333',
            ],
            [
                'name' => 'Városi Kulturális Műhely',
                'description' => 'Közösségi alkotóműhely és kulturális programok.',
                'category' => $allowedOrgCategories[5],
                'phone' => '+36 20 222 7788',
                'address' => 'Szentendre, Fő tér 3.',
                'email' => 'info@varosimuhely.hu',
                'website' => 'https://varosimuhely.hu',
                'bank_account' => 'HU44 9999 0000 1111 2222 3333 4444',
            ],
            [
                'name' => 'Mozgásban a Város Sportklub',
                'description' => 'Közösségi sportprogramok és szabadidős események.',
                'category' => $allowedOrgCategories[6],
                'phone' => '+36 70 333 2211',
                'address' => 'Győr, Baross Gábor út 10.',
                'email' => 'info@mozgasbanavaros.hu',
                'website' => 'https://mozgasbanavaros.hu',
                'bank_account' => 'HU11 6666 7777 8888 9999 0000 1111',
            ],
            [
                'name' => 'Szakmai Kerekasztal Szövetség',
                'description' => 'Szakmai együttműködés, érdekképviselet és konferenciák.',
                'category' => $allowedOrgCategories[8],
                'phone' => '+36 30 111 4455',
                'address' => 'Budapest, XIII. kerület, Szent István körút 8.',
                'email' => 'info@szakmaikerekasztal.hu',
                'website' => 'https://szakmaikerekasztal.hu',
                'bank_account' => 'HU22 7777 8888 9999 0000 1111 2222',
            ],
            [
                'name' => 'Közösségi Pont Alapítvány',
                'description' => 'Közösségfejlesztő programok és önkéntes koordináció.',
                'category' => $allowedOrgCategories[7],
                'phone' => '+36 1 777 8899',
                'address' => 'Miskolc, Széchenyi utca 20.',
                'email' => 'info@kozossegipont.hu',
                'website' => 'https://kozossegipont.hu',
                'bank_account' => 'HU98 5555 6666 7777 8888 9999 0000',
            ],
            [
                'name' => 'Humán Segítségnyújtás Egyesület',
                'description' => 'Humanitárius támogatás és krízishelyzetek kezelése.',
                'category' => $allowedOrgCategories[0],
                'phone' => '+36 20 111 2233',
                'address' => 'Szeged, Kárász utca 16.',
                'email' => 'info@humansegitseg.hu',
                'website' => 'https://humansegitseg.hu',
                'bank_account' => 'HU77 1234 0000 1111 2222 3333 4444',
            ],
        ];

        $faker = \Faker\Factory::create('hu_HU');
        for ($i = 0; $i < 8; $i++) {
            $organizationsData[] = [
                'name' => $faker->unique()->company(),
                'description' => $faker->sentence(12),
                'category' => $allowedOrgCategories[array_rand($allowedOrgCategories)],
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'email' => $faker->unique()->safeEmail(),
                'website' => substr($faker->url(), 0, 100),
                'bank_account' => $faker->iban('HU'),
            ];
        }

        $organizations = collect();

        foreach ($organizationsData as $index => $data) {
            $org = Organization::create($data);
            $organizations->push($org);

  
            $ownerUser = $allUsers->where('role', 'user')->values()->get($index % $allUsers->where('role', 'user')->count());

            OrganizationMember::create([
                'organization_id' => $org->id,
                'user_id' => $ownerUser->id,
                'role' => 'owner',
            ]);

    
            $managers = $allUsers
                ->where('id', '!=', $ownerUser->id)
                ->where('role', 'user')
                ->random(2);

            foreach ($managers as $manager) {
                OrganizationMember::firstOrCreate([
                    'organization_id' => $org->id,
                    'user_id' => $manager->id,
                ], [
                    'role' => 'manager',
                ]);
            }
        }


        // Az eseményeket az EventSeeder hozza létre - utána futtatom ezt
        $this->call(EventSeeder::class);

        // Az új események betöltésére van szükség az EventSeeder után
        $events = Event::all();

        $statuses = ['Aktív', 'Inaktív'];

        $registrationsCount = 0;
        foreach ($events as $event) {
            $participants = $allUsers->where('role', 'user')->random(3);

            foreach ($participants as $participant) {
                EventRegistration::create([
                    'user_id' => $participant->id,
                    'event_id' => $event->id,
                    'status' => $statuses[array_rand($statuses)],
                    'registered_at' => now()->subDays(rand(0, 5)),
                ]);
                $registrationsCount++;
            }
        }

        while ($registrationsCount < 20) {
            $event = $events->random();
            $participant = $allUsers->where('role', 'user')->random();

            EventRegistration::create([
                'user_id' => $participant->id,
                'event_id' => $event->id,
                'status' => $statuses[array_rand($statuses)],
                'registered_at' => now()->subDays(rand(0, 5)),
            ]);

            $registrationsCount++;
        }


        foreach ($events->take(5) as $event) {
            $org = $event->organization;
            $feedbackUser = $allUsers->where('role', 'user')->random();

            EventFeedback::create([
                'user_id' => $feedbackUser->id,
                'organization_id' => $org->id,
                'event_id' => $event->id,
                'rating' => rand(3, 5),
                'comment' => 'Nagyon jó hangulatú, jól szervezett esemény volt.',
                'image' => null,
            ]);
        }

        // Az eseményeket az EventSeeder hozza létre - utána futtatom ezt
        $this->call(EventSeeder::class);
    }
}
