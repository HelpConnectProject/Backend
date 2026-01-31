<?php

namespace App\Policies;

use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventRegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->role === 'superadmin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    

    public function view(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventRegistration $eventRegistration): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventRegistration $eventRegistration): bool
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        if ($eventRegistration->user_id === $user->id) {
            return true;
        }

        $event = $eventRegistration->event;

        return $user->organizations()
            ->where('organization_id', $event->organization_id)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventRegistration $eventRegistration): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventRegistration $eventRegistration): bool
    {
        return false;
    }
}
