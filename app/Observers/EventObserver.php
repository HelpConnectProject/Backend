<?php

namespace App\Observers;

use App\Models\Event;
use Carbon\Carbon;

class EventObserver
{

    public function retrieved(Event $event)
    {
        if ($event->date && Carbon::now() > $event->date && $event->status !== 'Inaktív') {
            $event->status = 'Inaktív';
           
        }
    }

}
