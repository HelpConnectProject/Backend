<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\OrganizationMember;
use App\Models\Organization;
use App\Models\User;


class OrganizationMemberController extends Controller
{
    use ResponseTrait, AuthorizesRequests;
    
    public function getOrganizationMembers($organizationId)
    {
        $organization = Organization::findOrFail($organizationId);

        $this->authorize('viewMembers', $organization);

        $members = $organization->members()->with('user')->get();

        return $this->sendResponse($members, 'Szervezet tagjai megjelenítve!');
    }

    public function addManagerRole(Request $request, $organizationId, $userId)
    {
        $organization = Organization::findOrFail($organizationId);

        $this->authorize('addManagerRole', $organization);

        $targetUser = User::findOrFail($userId);

        $member = OrganizationMember::where('organization_id', $organizationId)
            ->where('user_id', $targetUser->id)
            ->first();

        if ($member) {
            if ($member->role === 'owner') {
                return $this->sendError('Hiba', 'Az owner szerepkör nem módosítható managerre.', 409);
            }

            if ($member->role === 'manager') {
                return $this->sendResponse($member, 'A felhasználó már manager ebben a szervezetben.');
            }

            $member->role = 'manager';
            $member->save();

            return $this->sendResponse($member, 'Manager szerepkör beállítva.');
        }

        $member = OrganizationMember::create([
            'organization_id' => $organizationId,
            'user_id' => $targetUser->id,
            'role' => 'manager',
        ]);

        return $this->sendResponse($member, 'Manager hozzáadva a szervezethez.');
    }

    public function deleteManagerRole(Request $request, $organizationId, $userId)
    {
        $organization = Organization::findOrFail($organizationId);

        $this->authorize('deleteManagerRole', $organization);

        $targetUser = User::findOrFail($userId);

        $member = OrganizationMember::where('organization_id', $organizationId)
            ->where('user_id', $targetUser->id)
            ->first();

        if (! $member) {
            return $this->sendError('Hiba', 'A felhasználó nem tagja ennek a szervezetnek.', 404);
        }

        if ($member->role === 'owner') {
            return $this->sendError('Hiba', 'Az owner szerepkör nem törölhető.', 409);
        }

        if ($member->role !== 'manager') {
            return $this->sendError('Hiba', 'A felhasználó nem manager ebben a szervezetben.', 409);
        }

        $member->delete();

        return $this->sendResponse(null, 'Manager jogosultság eltávolítva a szervezetből.');
    }
}
