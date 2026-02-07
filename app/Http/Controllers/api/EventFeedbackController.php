<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventFeedback;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Event;



class EventFeedbackController extends Controller
{
    use ResponseTrait, AuthorizesRequests;
    public function getFeedbacks(Request $request, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return $this->sendError('Az esemény nem található!', 404);
        }

        if ($event->status !== 'Inaktív') {
            return $this->sendError('Csak inaktív eseményekhez lehet értékeléseket megtekinteni!', 403);
        }

        $feedbacks = EventFeedback::where('event_id', $eventId)
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->get();

        return $this->sendResponse($feedbacks, 'Feedbackek megjelenítve!');
    }

    public function createFeedback(Request $request, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return $this->sendError('Az esemény nem található!', 404);
        }

        if ($event->status !== 'Inaktív') {
            return $this->sendError('Csak inaktív eseményekhez lehet értékelést írni!', 403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['organization_id'] = $event->organization_id;
        $validated['event_id'] = $eventId;

        $feedback = EventFeedback::create($validated);

        return $this->sendResponse($feedback, 'Értékelés sikeresen létrehozva!', 201);
    }

    public function deleteFeedback(Request $request, $feedbackId)
    {
        $feedback = EventFeedback::find($feedbackId);

        if (!$feedback) {
            return $this->sendError('Az értékelés nem található!', 404);
        }

        $this->authorize('delete', $feedback);

        $feedback->delete();

        return $this->sendResponse($feedback, 'Értékelés sikeresen törölve!');
    }
}
