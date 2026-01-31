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

        Event::findOrFail($eventId);

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
