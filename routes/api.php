<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\EventRegistrationController;
use App\Http\Controllers\api\EventFeedbackController;

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

    // Event Registration
    Route::post('/registerevent/{eventId}', [EventRegistrationController::class, 'createEventRegistration']);
    Route::get('/eventregistrations', [EventRegistrationController::class, 'getEventRegistrations']);
    Route::delete('/deleteeventregistration/{eventRegistration}', [EventRegistrationController::class, 'deleteEventRegistration']);
    Route::get('/owneventregistrations', [EventRegistrationController::class, 'getOwnEventRegistrations']);
    
    // Event Feedback
    Route::post('/createfeedback/{eventId}', [EventFeedbackController::class, 'createFeedback']);
    Route::delete('/deletefeedback/{feedbackId}', [EventFeedbackController::class, 'deleteFeedback']);

    
});

// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'getUsers']);

// Organization
Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);

// Event
Route::get('/events', [EventController::class, 'getEvents']);
Route::get('/getinactiveevent/{id}', [EventController::class, 'getInactiveEvent']);

// Event Registration

//Event feedbacks
Route::get('/eventfeedbacks/{eventId}', [EventFeedbackController::class, 'getFeedbacks']);


