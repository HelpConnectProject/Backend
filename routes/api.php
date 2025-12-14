<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\UserController;

Route::group([ "middleware" => [ "auth:sanctum" ]], function() {

    // User
    Route::post('/logout', [UserController::class, 'logout']);

    // Organization
    Route::post('/addorganization', [OrganizationController::class, 'createOrganization']);
    Route::get('/ownorganizations', [OrganizationController::class, 'getOwnOrganizations']);
    Route::put('/updateorganization/{organization}', [OrganizationController::class, 'updateOrganization']);
    Route::delete('/deleteorganization/{organization}', [OrganizationController::class, 'deleteOrganization']);
});

// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'getUsers']);

// Organization
Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);

