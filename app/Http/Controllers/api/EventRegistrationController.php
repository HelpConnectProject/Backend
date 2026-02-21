<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventRegistrationController extends Controller
{
    use ResponseTrait, AuthorizesRequests;
    
    public function getEventRegistrations()
    {
        $this->authorize('viewAny', EventRegistration::class);
        $eventRegistrations = EventRegistration::all();

        return $this->sendResponse($eventRegistrations, 'Event registrations megjelenítve!');
    }

    public function getRegistrationByOrg($eventId) {
   
    if (!$eventId) {
        return $this->sendError('Hiba', 'event_id paraméter hiányzik.', 400);
    }
    $event = Event::find($eventId);
    if (!$event) {
        return $this->sendError('Hiba', 'Esemény nem található.', 404);
    }
    $registrations = EventRegistration::with('user')
        ->where('event_id', $eventId)
        ->get();

    $users = $registrations->map(function($reg) {
        return [
            'id' => $reg->user->id,
            'name' => $reg->user->name,
            'email' => $reg->user->email,
            'phone' => $reg->user->phone,
            'city' => $reg->user->city,
            'about' => $reg->user->about,
            'registered_at' => $reg->registered_at,
        ];
    });

    return $this->sendResponse($users, 'Jelentkezett userek listája.');
    }

    public function getOwnEventRegistrations(Request $request)
    {
        $this->authorize('view', EventRegistration::class);
        $user = $request->user();
        $eventRegistrations = EventRegistration::where('user_id', $user->id)->get();

        return $this->sendResponse($eventRegistrations, 'Saját esemény jelentkezések megjelenítve!');
    }    

    public function createEventRegistration(Request $request, $eventId)
    {

        $this->authorize('create', EventRegistration::class);

        $user = $request->user();

        $event = Event::findOrFail($eventId);

        $currentCount = EventRegistration::where('event_id', $eventId)->count();
        if ($event->capacity && $currentCount >= $event->capacity) {
            return $this->sendError('Hiba', 'Ez az esemény megtelt és már nem lehet rá jelentkezni.', 409);
        }

        $alreadyRegistered = EventRegistration::where('user_id', $user->id)
            ->where('event_id', $eventId)
            ->exists();

        if ($alreadyRegistered) {
            return $this->sendError('Hiba', 'Már jelentkeztél erre az eseményre.', 409);
        }

        $eventRegistration = EventRegistration::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
            'status' => 'Aktív',
            'registered_at' => now(),
        ]);

        return $this->sendResponse($eventRegistration, 'Sikeres jelentkezés az eseményre!');
    }

    public function deleteEventRegistration(EventRegistration $eventRegistration)
    {
        $this->authorize('delete', $eventRegistration);

        $eventRegistration->delete();

        return $this->sendResponse([], 'Jelentkezés törölve!');
    }

    


        
}
