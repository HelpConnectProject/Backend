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


        $organizationsData = [
            [
                'name' => 'Segítő Kezek Alapítvány',
                'description' => 'Rászoruló családok támogatása és adománygyűjtés.',
                'category' => 'Szociális ellátás',
                'phone' => '+36 1 234 5678',
                'address' => 'Budapest, V. kerület, Nádor utca 4.',
                'email' => 'info@segito-kezek.hu',
                'website' => 'https://segito-kezek.hu',
                'bank_account' => 'HU12 1111 2222 3333 4444 5555 6666',
            ],
            [
                'name' => 'Mosolygó Gyermekek Egyesület',
                'description' => 'Hátrányos helyzetű gyerekek programjainak szervezése.',
                'category' => 'Gyermekvédelem',
                'phone' => '+36 30 555 1122',
                'address' => 'Debrecen, Piac utca 12.',
                'email' => 'info@mosolyogyermekek.hu',
                'website' => 'https://mosolyogyermekek.hu',
                'bank_account' => 'HU34 2222 3333 4444 5555 6666 7777',
            ],
            [
                'name' => 'Zöld Jövő Környezetvédelmi Kör',
                'description' => 'Faültetés, szemétszedés, környezeti nevelés.',
                'category' => 'Környezetvédelem',
                'phone' => '+36 20 987 6543',
                'address' => 'Szeged, Kossuth Lajos sugárút 5.',
                'email' => 'info@zoldjovo.hu',
                'website' => 'https://zoldjovo.hu',
                'bank_account' => 'HU56 3333 4444 5555 6666 7777 8888',
            ],
            [
                'name' => 'Ifjúsági Mentor Program',
                'description' => 'Fiatalok karrier- és tanulmányi mentorálása.',
                'category' => 'Ifjúságfejlesztés',
                'phone' => '+36 20 444 5566',
                'address' => 'Pécs, Széchenyi tér 2.',
                'email' => 'info@ifjusagimentor.hu',
                'website' => 'https://ifjusagimentor.hu',
                'bank_account' => 'HU72 4444 5555 6666 7777 8888 9999',
            ],
            [
                'name' => 'Egészséges Életmód Klub',
                'description' => 'Szűrések, sportprogramok, ismeretterjesztés.',
                'category' => 'Egészség',
                'phone' => '+36 1 777 8899',
                'address' => 'Győr, Baross Gábor út 10.',
                'email' => 'info@egeszseseletmodklub.hu',
                'website' => 'https://egeszseseletmodklub.hu',
                'bank_account' => 'HU98 5555 6666 7777 8888 9999 0000',
            ],
            [
                'name' => 'Idősekért Összefogás',
                'description' => 'Magányos idősek látogatása, bevásárlás, ügyintézés.',
                'category' => 'Idősgondozás',
                'phone' => '+36 70 333 2211',
                'address' => 'Miskolc, Széchenyi utca 20.',
                'email' => 'info@idosekertosszefogas.hu',
                'website' => 'https://idosekertosszefogas.hu',
                'bank_account' => 'HU11 6666 7777 8888 9999 0000 1111',
            ],
            [
                'name' => 'Utcai Ifjúsági Szolgálat',
                'description' => 'Fiataloknak szóló közösségi programok, prevenció.',
                'category' => 'Ifjúságvédelem',
                'phone' => '+36 30 111 4455',
                'address' => 'Székesfehérvár, Fő utca 8.',
                'email' => 'info@utcaiifjusag.hu',
                'website' => 'https://utcaiifjusag.hu',
                'bank_account' => 'HU22 7777 8888 9999 0000 1111 2222',
            ],
            [
                'name' => 'Nyitott Ajtók Családsegítő',
                'description' => 'Családsegítő szolgáltatások, jogi és pszichológiai tanácsadás.',
                'category' => 'Családsegítés',
                'phone' => '+36 1 222 3344',
                'address' => 'Budapest, XI. kerület, Bartók Béla út 15.',
                'email' => 'info@nyitottajtok.hu',
                'website' => 'https://nyitottajtok.hu',
                'bank_account' => 'HU33 8888 9999 0000 1111 2222 3333',
            ],
            [
                'name' => 'Esély Mindenkinek Alapítvány',
                'description' => 'Fogyatékkal élők támogatása, inklúzív programok.',
                'category' => 'Esélyegyenlőség',
                'phone' => '+36 20 222 7788',
                'address' => 'Kecskemét, Rákóczi út 3.',
                'email' => 'info@eselymindenkinek.hu',
                'website' => 'https://eselymindenkinek.hu',
                'bank_account' => 'HU44 9999 0000 1111 2222 3333 4444',
            ],
            [
                'name' => 'Tudás Hídja Oktatási Központ',
                'description' => 'Ingyenes felzárkóztató és nyelvi képzések.',
                'category' => 'Oktatás',
                'phone' => '+36 30 999 8877',
                'address' => 'Szombathely, Fő tér 1.',
                'email' => 'info@tudashidja.hu',
                'website' => 'https://tudashidja.hu',
                'bank_account' => 'HU55 0000 1111 2222 3333 4444 5555',
            ],
        ];

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


        $events = collect();

        $eventTemplates = [
            'Adománygyűjtő vásár',
            'Családi nap a parkban',
            'Környezettudatos hétvége',
            'Önkéntes toborzó est',
            'Jótékonysági futóverseny',
            'Nyílt nap a központban',
            'Karrier tanácsadás fiataloknak',
            'Egészségnap szűrésekkel',
            'Közös faültetés',
            'Karácsonyi ajándékgyűjtés',
        ];

        foreach ($organizations as $i => $org) {

            $title = $eventTemplates[$i % count($eventTemplates)];

            $event = Event::create([
                'organization_id' => $org->id,
                'title' => $title,
                'description' => $title . ' az adott szervezet támogatására.',
                'location' => $org->address ?? 'Online',
                'date' => now()->addDays($i + 3)->setTime(17, 0),
                'status' => 'Aktív',
                'capacity' => 50 + $i * 5,
            ]);

            $events->push($event);
        }

        while ($events->count() < 10) {
            $org = $organizations->random();
            $event = Event::create([
                'organization_id' => $org->id,
                'title' => 'Extra jótékonysági esemény',
                'description' => 'Kiegészítő program az adományok gyűjtésére.',
                'location' => $org->address ?? 'Online',
                'date' => now()->addDays($events->count() + 5)->setTime(18, 0),
                'status' => 'Aktív',
                'capacity' => 80,
            ]);
            $events->push($event);
        }

        $statuses = ['Függőben', 'Elfogadva', 'Lemondva'];

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
    }
}
