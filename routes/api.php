<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\EventController;

Route::group([ "middleware" => [ "auth:sanctum" ]], function() {

    // User
    Route::post('/logout', [UserController::class, 'logout']);

    // Organization
    Route::post('/addorganization', [OrganizationController::class, 'createOrganization']);
    Route::get('/ownorganizations', [OrganizationController::class, 'getOwnOrganizations']);
    Route::put('/updateorganization/{organization}', [OrganizationController::class, 'updateOrganization']);
    Route::delete('/deleteorganization/{organization}', [OrganizationController::class, 'deleteOrganization']);
    
    // Event
    Route::get('/ownevents', [EventController::class, 'getOwnEvents']);
    Route::post('/createevent/{organizationId}', [EventController::class, 'createEvent']);
    Route::put('/updateevent/{organizationId}/{eventId}', [EventController::class, 'updateEvent']);
    Route::delete('/deleteevent/{organizationId}/{eventId}', [EventController::class, 'deleteEvent']);
    
});

// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'getUsers']);

// Organization
Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);

// Event
Route::get('/events', [EventController::class, 'getEvents']);

