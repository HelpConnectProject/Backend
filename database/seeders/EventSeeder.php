<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $events = [
            // Organization 1 - Segítő Kezek Alapítvány (5 esemény)
            [
                'organization_id' => 1,
                'title' => 'Adománygyűjtés a rászorulók számára',
                'description' => 'Közös adománygyűjtés a szociálisan hátrányos helyzetű családok megsegítésére.',
                'location' => 'Budapest, Városliget',
                'date' => now()->addDays(7)->setHour(10)->setMinute(0),
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 1,
                'title' => 'Mentális egészség workshop',
                'description' => 'Interaktív workshop a mentális egészség és wellbeing témájában.',
                'location' => 'Budapest, Erkel Szálló',
                // Múltbeli esemény (vége van) -> inaktív; ehhez vannak előre seedelt értékelések is.
                'date' => now()->subDays(14)->setHour(14)->setMinute(30),
                'capacity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 1,
                'title' => 'Szociális támogatási szeminár',
                'description' => 'Hogyan lehet hatékonyan segíteni a rászoruló családoknak.',
                'location' => 'Budapest, Pesti Vigadó',
                'date' => now()->addDays(21)->setHour(11)->setMinute(0),
                'capacity' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 1,
                'title' => 'Karácsonyváró adománygyűjtés',
                'description' => 'Karácsonyi ajándékgyűjtés a szegény családok gyerekeihez.',
                'location' => 'Budapest, V. kerület',
                'date' => now()->addDays(35)->setHour(16)->setMinute(0),
                'capacity' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 1,
                'title' => 'Önkéntes toborzás és képzés',
                'description' => 'Új önkéntesek toborzása és alapvetô képzése.',
                'location' => 'Budapest, Városháza',
                'date' => now()->addDays(28)->setHour(13)->setMinute(0),
                'capacity' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Organization 2 - Közösségi Fejlesztés Szövetség (5 esemény)
            [
                'organization_id' => 2,
                'title' => 'Közösségi nap a városban',
                'description' => 'Szórakoztató és informatív közösségi rendezvény a helyi közösség erősítésére.',
                'location' => 'Debrecen, Nagyerdő',
                'date' => now()->addDays(10)->setHour(11)->setMinute(0),
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
                'capacity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2,
                'title' => 'Közösségi kert projekt indítása',
                'description' => 'Közös kertépítés a város zöldítésére és közösségépítésre.',
                'location' => 'Debrecen, Nagyerdei Park',
                'date' => now()->addDays(15)->setHour(10)->setMinute(0),
                'capacity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2,
                'title' => 'Szomszédság építő piac',
                'description' => 'Helyi termelôk és kézművesek vására.',
                'location' => 'Debrecen, Északi Pályaudvar',
                'date' => now()->addDays(18)->setHour(8)->setMinute(0),
                'capacity' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2,
                'title' => 'Közösségi tárház fejlesztési fórum',
                'description' => 'Szabad dolgok megosztásának erôsítése a közösségben.',
                'location' => 'Debrecen, Közösségi Ház',
                'date' => now()->addDays(25)->setHour(14)->setMinute(0),
                'capacity' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Organization 3 - Ifjúsági Mentorálási Alapítvány (5 esemény)
            [
                'organization_id' => 3,
                'title' => 'Fiatalok karrierfóruma',
                'description' => 'Pályaválasztási tanácsadás és karrierépítési tippek fiatalok számára.',
                'location' => 'Szeged, Szegedi Tudományegyetem',
                'date' => now()->addDays(8)->setHour(15)->setMinute(0),
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
                'capacity' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 3,
                'title' => 'Digitális készségek workshop',
                'description' => 'Programozás és digitális eszközök alapjai fiatalok számára.',
                'location' => 'Szeged, Technológiai Központ',
                'date' => now()->addDays(12)->setHour(16)->setMinute(0),
                'capacity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 3,
                'title' => 'Mentor-mentorált párosítási esemény',
                'description' => 'Új mentor-mentorált párok megismerkedésének rendezvénye.',
                'location' => 'Szeged, Egyetem Klubja',
                'date' => now()->addDays(5)->setHour(17)->setMinute(0),
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 3,
                'title' => 'Leadership és személyiségfejlesztés tréning',
                'description' => 'Vezetési készségek fejlesztése fiataloknak.',
                'location' => 'Szeged, Business Hub',
                'date' => now()->addDays(32)->setHour(10)->setMinute(0),
                'capacity' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Organization 4 - Egészséges Élet Szövetsége (5 esemény)
            [
                'organization_id' => 4,
                'title' => 'Futóversenyen keresztül a jó egészségért',
                'description' => 'Szórakoztató futóverseny az egészséges életmód népszerűsítésére.',
                'location' => 'Pécs, Mecsek alja',
                'date' => now()->addDays(12)->setHour(8)->setMinute(0),
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
                'capacity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 4,
                'title' => 'Jóga és meditáció kezdőknek',
                'description' => 'Relaxációs és wellness foglalkozás.',
                'location' => 'Pécs, Wellnes Centrum',
                'date' => now()->addDays(9)->setHour(18)->setMinute(0),
                'capacity' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 4,
                'title' => 'Egészséges életmód expo',
                'description' => 'Vállalatoknak és egyéneknek bemutatkozási lehetôség.',
                'location' => 'Pécs, Messze-Völgyi Sportcsarnok',
                'date' => now()->addDays(22)->setHour(10)->setMinute(0),
                'capacity' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 4,
                'title' => 'Koronavírus utáni rehabilitáció workshop',
                'description' => 'Egészségügyi tanácsadás a covid utáni felépüléshez.',
                'location' => 'Pécs, Egészségügyi Egyetem',
                'date' => now()->addDays(30)->setHour(14)->setMinute(0),
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Organization 5 - Fenntarthatóság Szövetsége (5 esemény)
            [
                'organization_id' => 5,
                'title' => 'Fenntartható célok megvalósításáért szeminár',
                'description' => 'Tudnivalók a fenntartható fejlődési célokról és azok megvalósításáról.',
                'location' => 'Győr, Városi Könyvtár',
                'date' => now()->addDays(15)->setHour(10)->setMinute(0),
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
                'capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 5,
                'title' => 'Hulladékmentes élet - gyakorlati tippek',
                'description' => 'Hogyan csökkentsük a hulladéktermelésünket?',
                'location' => 'Győr, Ökológiai Központ',
                'date' => now()->addDays(11)->setHour(16)->setMinute(0),
                'capacity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 5,
                'title' => 'Közös biketrip a Rábáig',
                'description' => 'Kerékpáros túra a fenntartható közlekedés népszerûsítéséhez.',
                'location' => 'Győr, Rába Völgy',
                'date' => now()->addDays(17)->setHour(8)->setMinute(0),
                'capacity' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 5,
                'title' => 'Fenntartható Fashion Show',
                'description' => 'Ökológikus ruhadesignerek és divatmárkák bemutatása.',
                'location' => 'Győr, Kulturális Központ',
                'date' => now()->addDays(26)->setHour(18)->setMinute(0),
                'capacity' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Több múltbeli esemény (nem vesz el a meglévő aktívakból, csak hozzáad).
        $pastTemplates = [
            [
                'title' => 'Önkéntes köszönő est',
                'description' => 'Kötetlen találkozó és visszajelzés-gyűjtés az önkéntesekkel.',
                'location' => 'Budapest, Közösségi Tér',
                'capacity' => 60,
            ],
            [
                'title' => 'Téli ruhaosztás',
                'description' => 'Meleg ruhák és takarók kiosztása rászorulóknak.',
                'location' => 'Debrecen, Fő tér',
                'capacity' => 180,
            ],
            [
                'title' => 'Közösségi szemétszedés',
                'description' => 'Közös környezetszépítő akció, zsákok és kesztyűk biztosítva.',
                'location' => 'Szeged, Tisza-part',
                'capacity' => 120,
            ],
            [
                'title' => 'Egészségmegőrző szűrőnap',
                'description' => 'Alap szűrések és tanácsadás szakemberekkel.',
                'location' => 'Pécs, Egészség Központ',
                'capacity' => 90,
            ],
            [
                'title' => 'Közösségi főzés és ételosztás',
                'description' => 'Közös főzés önkéntesekkel, majd ételosztás a helyszínen.',
                'location' => 'Győr, Közösségi Ház',
                'capacity' => 140,
            ],
            [
                'title' => 'Adományválogatás és csomagolás',
                'description' => 'Beérkezett adományok rendszerezése, csomagok összeállítása.',
                'location' => 'Budapest, Raktár',
                'capacity' => 50,
            ],
            [
                'title' => 'Mentorprogram nyílt nap',
                'description' => 'Bemutató és tapasztalatmegosztás mentorokkal és mentoráltakkal.',
                'location' => 'Szeged, Központi Könyvtár',
                'capacity' => 70,
            ],
            [
                'title' => 'Fenntarthatósági kerekasztal',
                'description' => 'Beszélgetés gyakorlati zöld megoldásokról a mindennapokban.',
                'location' => 'Győr, Városi Könyvtár',
                'capacity' => 80,
            ],
        ];

        $orgIds = [1, 2, 3, 4, 5];
        $daysAgoPool = [3, 5, 8, 10, 14, 21, 28, 35, 45, 60, 75, 90, 120, 150, 180];

        foreach ($orgIds as $orgId) {
            $picked = collect($pastTemplates)->shuffle()->take(6)->values();
            foreach ($picked as $index => $tpl) {
                $daysAgo = $daysAgoPool[array_rand($daysAgoPool)];
                $eventDate = $now->copy()->subDays($daysAgo)->setHour(9 + ($index % 10))->setMinute([0, 15, 30, 45][$index % 4]);

                $events[] = [
                    'organization_id' => $orgId,
                    'title' => $tpl['title'],
                    'description' => $tpl['description'],
                    'location' => $tpl['location'],
                    'date' => $eventDate,
                    'capacity' => $tpl['capacity'],
                    'created_at' => $eventDate->copy()->subDays(rand(1, 14)),
                    'updated_at' => $eventDate->copy()->subDays(rand(0, 7)),
                ];
            }
        }

        // Statusz mindig a dátum alapján kerül be (ne legyen "kézzel" megadva seedben sem).
        $events = array_map(function (array $event) use ($now) {
            $date = $event['date'] instanceof \DateTimeInterface
                ? Carbon::instance($event['date'])
                : Carbon::parse($event['date']);

            $event['status'] = $now->gt($date) ? 'Inaktív' : 'Aktív';
            return $event;
        }, $events);

        DB::table('events')->insert($events);

        // Sok komment/értékelés automatikusan a múltbeli eseményekre.
        $userIds = DB::table('users')->where('role', 'user')->pluck('id')->all();
        if (empty($userIds)) {
            $userIds = DB::table('users')->pluck('id')->all();
        }

        $pastEvents = DB::table('events')
            ->select('id', 'organization_id', 'date')
            ->where('date', '<', $now)
            ->get();

        if (!empty($userIds) && $pastEvents->isNotEmpty()) {
            $commentPool = [
                'Nagyon jó hangulatú volt, visszajönnék újra.',
                'Jól szervezett, pontos kezdés, kedves szervezők.',
                'Hasznos program, sokat adott, köszönöm!',
                'A helyszín és a lebonyolítás is rendben volt.',
                'Jó közösség, szívesen csatlakoznék legközelebb is.',
                'Kicsit zsúfolt volt, de összességében pozitív élmény.',
                'Szerettem, hogy volt egyértelmű feladatkiosztás.',
                'A kommunikáció előtte jobb is lehetett volna, de a program jó volt.',
                'Nagyon inspiráló, sok ötletet vittem haza.',
                'Remek kezdeményezés, örülök, hogy részt vettem.',
                'Barátságos légkör, segítőkész csapat.',
                'A szervezők rugalmasak voltak, minden kérdésre válaszoltak.',
                'Jó tempó, nem volt túl hosszú, nem volt túl rövid.',
                'Külön tetszett, hogy volt visszajelzési lehetőség a végén.',
                'Szuper volt a csapatmunka és a közös eredmény.',
                'Összességében nagyon elégedett vagyok.',
            ];

            $feedbackRows = [];
            foreach ($pastEvents as $event) {
                $feedbackCount = rand(8, 18);
                $eventDate = Carbon::parse($event->date);

                for ($i = 0; $i < $feedbackCount; $i++) {
                    $createdAt = $eventDate->copy()->addHours(rand(2, 96));

                    $ratingRoll = rand(1, 100);
                    $rating = $ratingRoll <= 15 ? 3 : ($ratingRoll <= 55 ? 4 : 5);

                    $feedbackRows[] = [
                        'user_id' => $userIds[array_rand($userIds)],
                        'organization_id' => $event->organization_id,
                        'event_id' => $event->id,
                        'rating' => $rating,
                        'comment' => $commentPool[array_rand($commentPool)],
                        'image' => null,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ];
                }
            }

            DB::table('event_feedbacks')->insert($feedbackRows);
        }
    }
}
