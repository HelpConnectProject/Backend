<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Event;
use App\Models\Organization;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;




class EventController extends Controller
{
    use ResponseTrait, AuthorizesRequests; 
    public function getEvents()
    {
        $events = Event::where('date', '>=', Carbon::now())->get();

        return $this->sendResponse($events, 'Események megjelenítve!');
    }

     public function getInactiveEvent($id)
    {
        $events = Event::where('date', '<', Carbon::now())
               ->where('organization_id', $id)
               ->get();



        return $this->sendResponse($events, 'Események megjelenítve!');
    }
    

    public function getOwnEvents(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'superadmin') {
           
            $events = Event::withTrashed()
                ->with(['organization' => function ($query) {
                    $query->withTrashed();
                }])
                ->get()
                ->groupBy('organization_id')
                ->map(function ($orgEvents) {
                    $firstEvent = $orgEvents->first();
                    return [
                        'organization_id' => $firstEvent->organization_id,
                        'organization_name' => $firstEvent->organization?->name ?? 'Törölt szervezet',
                        'events' => $orgEvents->makeHidden('organization')->values(),
                    ];
                })
                ->values();
                

            return $this->sendResponse($events, 'Összes esemény szervezetenként lebontva.');
        } 
        else { 
            
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

        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

        $organization = Organization::findOrFail($organizationId);

        $this->authorize('create', Event::class);

        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

        $validated = $request->validated();

        $event = new Event([
            'organization_id' => $organizationId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['date'],
            'capacity' => $validated['capacity'],
        ]);

        $event->setStatusByDate()->save();

        return $this->sendResponse($event, 'Esemény sikeresen létrehozva!');
    }

    public function updateEvent(EventRequest $request, $organizationId, $eventId)
    {
        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

        $organization = Organization::findOrFail($organizationId);
        
        $event = Event::findOrFail($eventId);

        if ($event->organization_id != $organizationId) {
            return $this->sendError('Nem található', 'Ez az esemény nem tartozik ehhez a szervezethez.', 404);
        }

        $this->authorize('update', $event);

        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

        $validated = $request->validated();

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['date'],
            'capacity' => $validated['capacity'],
        ]);

        $event->setStatusByDate()->save();

        return $this->sendResponse($event, 'Esemény sikeresen frissítve!');
    }

    public function deleteEvent(Request $request, $organizationId, $eventId)
    {
       
        if (!$request->user()) {
            return $this->sendError('Nincs engedély', 'Bejelentkezés szükséges.', 401);
        }

       
        $organization = Organization::findOrFail($organizationId);

        $event = Event::findOrFail($eventId);
        
        if ($event->organization_id != $organizationId) {
            return $this->sendError('Nem található', 'Ez az esemény nem tartozik ehhez a szervezethez.', 404);
        }

       
        $this->authorize('delete', $event);

       
        $user = $request->user();
        $isOwnerOrManager = $user->organizations()
            ->where('organization_id', $organizationId)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();

        if (!$isOwnerOrManager && $user->role !== 'superadmin') {
            return $this->sendError('Nincs engedély', 'Nem vagy owner vagy manager ebben a szervezetben.', 403);
        }

       
        $event->delete();

        return $this->sendResponse([], 'Esemény sikeresen törölve!');
    }

    
}