<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Event;
use App\Models\Organization;
use App\Http\Requests\EventRequest;




class EventController extends Controller
{
    use ResponseTrait, AuthorizesRequests; 
    public function getEvents()
    {
        $events = Event::all();

        return $this->sendResponse($events, 'Események megjelenítve!');
    }
    

    public function getOwnEvents(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'superadmin') {
            // Superadmin látja az összes eseményt szervezetenként
            $events = Event::get()
                ->groupBy('organization_id')
                ->map(function ($orgEvents) {
                    $firstEvent = $orgEvents->first();
                    return [
                        'organization_id' => $firstEvent->organization_id,
                        'organization_name' => $firstEvent->organization->name,
                        'events' => $orgEvents->makeHidden('organization')->values(),
                    ];
                })
                ->values();

            return $this->sendResponse($events, 'Összes esemény szervezetenként lebontva.');
        } 
        else { 
            // Felhasználó csak azoknak a szervezeteknek az eseményeit látja, ahol tagja
            $userOrganizations = $user->organizations()->pluck('organization_id');

            $events = Event::whereIn('organization_id', $userOrganizations)
                ->get()
                ->groupBy('organization_id')
                ->map(function ($orgEvents) {
                    $firstEvent = $orgEvents->first();
                    return [
                        'organization_id' => $firstEvent->organization_id,
                        'organization_name' => $firstEvent->organization->name,
                        'events' => $orgEvents->makeHidden('organization')->values(),
                    ];
                })
                ->values();

            if ($events->isEmpty()) {
                return $this->sendResponse([], 'Nincsenek eseményei.');
            }

            return $this->sendResponse($events, 'Saját szervezetek eseményei szervezetenként lebontva.');
        }
    }


    public function createEvent(EventRequest $request, $organizationId)
    {
        // Bejelentkezettség ellenőrzése
        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

        // Szervezet létezésének ellenőrzése
        $organization = Organization::findOrFail($organizationId);

        // Policy engedélyezés - van-e általános joga eseményt létrehozni?
        $this->authorize('create', Event::class);

        // Specifikus szervezet ellenőrzés - owner vagy manager-e?
        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

        // Validáció
        $validated = $request->validated();

        // Event létrehozása az adott szervezethez
        $event = Event::create([
            'organization_id' => $organizationId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['date'],
            'status' => $validated['status'],
            'capacity' => $validated['capacity'],
        ]);

        return $this->sendResponse($event, 'Esemény sikeresen létrehozva!');
    }

    public function updateEvent(EventRequest $request, $organizationId, $eventId)
    {
        // Bejelentkezettség ellenőrzése
        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

        // Szervezet létezésének ellenőrzése
        $organization = Organization::findOrFail($organizationId);

        // Event létezésének ellenőrzése
        $event = Event::findOrFail($eventId);

        // Ellenőrizd, hogy az event az adott szervezethez tartozik-e
        if ($event->organization_id != $organizationId) {
            return $this->sendError('Nem található', 'Ez az esemény nem tartozik ehhez a szervezethez.', 404);
        }

        // Policy engedélyezés - van-e általános joga eseményt módosítani?
        $this->authorize('update', $event);

        // Specifikus szervezet ellenőrzés - owner vagy manager-e?
        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

        // Validáció
        $validated = $request->validated();

        // Event frissítése
        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['date'],
            'status' => $validated['status'],
            'capacity' => $validated['capacity'],
        ]);

        return $this->sendResponse($event, 'Esemény sikeresen frissítve!');
    }

    public function deleteEvent(Request $request, $organizationId, $eventId)
    {
        // Bejelentkezettség ellenőrzése
        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

        // Szervezet létezésének ellenőrzése
        $organization = Organization::findOrFail($organizationId);

        // Event létezésének ellenőrzése
        $event = Event::findOrFail($eventId);

        // Ellenőrizd, hogy az event az adott szervezethez tartozik-e
        if ($event->organization_id != $organizationId) {
            return $this->sendError('Nem található', 'Ez az esemény nem tartozik ehhez a szervezethez.', 404);
        }

        // Policy engedélyezés - van-e általános joga eseményt törölni?
        $this->authorize('delete', $event);

        // Specifikus szervezet ellenőrzés - owner vagy manager-e?
        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

        // Event törlése
        $event->delete();

        return $this->sendResponse([], 'Esemény sikeresen törölve!');
    }

    
}