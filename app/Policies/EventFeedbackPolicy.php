<?php

namespace App\Policies;

use App\Models\EventFeedback;
use App\Models\User;

class EventFeedbackPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'superadmin';
    }

    public function view(User $user, EventFeedback $eventFeedback): bool
    {
        return $user !== null;
    }

    public function create(?User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, EventFeedback $eventFeedback): bool
    {
        return false;
    }

    public function delete(User $user, EventFeedback $eventFeedback): bool
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        if ($eventFeedback->user_id === $user->id) {
            return true;
        }

        return $user->organizations()
            ->where('organization_id', $eventFeedback->organization_id)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();
    }
}
