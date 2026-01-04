<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Szuperadmin mindig létrehozhat eseményt
        if ($user->role === 'superadmin') {
            return true;
        }

        // Rendes felhasználó csak akkor, ha tagja valamilyen szervezetnek
        // és owner vagy manager szerepe van
        return $user->organizations()
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        // Szuperadmin mindig módosíthat eseményt
        if ($user->role === 'superadmin') {
            return true;
        }

        // Rendes felhasználó csak akkor, ha owner vagy manager az esemény szervezetében
        return $user->organizations()
            ->where('organization_id', $event->organization_id)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        // Szuperadmin mindig törölhet eseményt
        if ($user->role === 'superadmin') {
            return true;
        }

        // Rendes felhasználó csak akkor, ha owner vagy manager az esemény szervezetében
        return $user->organizations()
            ->where('organization_id', $event->organization_id)
            ->whereIn('organization_members.role', ['owner', 'manager'])
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return false;
    }
}
