<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\OrganizationRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationController extends Controller
{

    use ResponseTrait, AuthorizesRequests;

    public function getOrganizations()
    {
        $organizations = Organization::all();

        return $this->sendResponse($organizations, 'Organizations megjelenítve!');
    }

    public function getOwnOrganizations(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'superadmin') {
            $organizations = Organization::withTrashed()->get();

        } else {
            $organizations = Organization::whereHas('members', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }

        return $this->sendResponse($organizations, 'Saját szervezetek megjelenítve!');
    }

    public function createOrganization(OrganizationRequest $request)
    {
        $this->authorize('create', Organization::class);

        $organization = Organization::create($request->validated());

        $organization->members()->create([
            'user_id' => $request->user()->id,
            'role' => 'owner',
        ]);
        return $this->sendResponse($organization, 'Szervezet létrehozva!');
    }

    public function updateOrganization(OrganizationRequest $request, Organization $organization)
    {
        $this->authorize('update', $organization);

        $organization->update($request->validated());

        return $this->sendResponse($organization, 'Szervezet frissítve!');

    }

    public function deleteOrganization(Organization $organization)
    {
        $this->authorize('delete', $organization);

        $organization->delete();

        return $this->sendResponse($organization, 'Szervezet törölve!');
    }

    
}
