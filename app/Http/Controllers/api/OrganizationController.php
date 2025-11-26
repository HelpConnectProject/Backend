<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends ResponseController
{
    public function getOrganizations()
    {
        $organizations = Organization::all();

        return $this->sendResponse($organizations, 'Organizations megjelenítve!');
    }
}
