<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\EventRegistrationController;
use App\Http\Controllers\api\EventFeedbackController;
use App\Http\Controllers\api\OrganizationMemberController;
use App\Models\User;


Route::group([ "middleware" => [ "auth:sanctum" ]], function() {

    // User
    Route::post('/logout', [UserController::class, 'logout']);
    Route::put('/updateprofile', [UserController::class, 'updateProfile']);
    Route::delete('/deleteprofile', [UserController::class, 'deleteProfile']);
    Route::get('/ownprofile', [UserController::class, 'getOwnProfile']);
    Route::post('/me/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::get('/userbyemail', [UserController::class, 'getUserByEmail']);

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

    // Organization Members
    Route::get('/organizationmembers/{organizationId}', [OrganizationMemberController::class, 'getOrganizationMembers']);
    Route::post('/addmanager/{organizationId}/{userId}', [OrganizationMemberController::class, 'addManagerRole']);
    Route::delete('/deletemanager/{organizationId}/{userId}', [OrganizationMemberController::class, 'deleteManagerRole']);

    
});

Route::post('/change-password', [UserController::class, 'requestPasswordReset'])->name('password.reset.request');

// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'getUsers']);

// Organization
Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);

// Event
Route::get('/events', [EventController::class, 'getEvents']);
Route::get('/getinactiveevent/{id}', [EventController::class, 'getInactiveEvent']);
Route::get('/getregistrationbyorg/{eventId}', [EventRegistrationController::class, 'getRegistrationByOrg']);


// Event Registration

//Event feedbacks
Route::get('/eventfeedbacks/{eventId}', [EventFeedbackController::class, 'getFeedbacks']);

//Email verification
Route::get("verify_email/{id}/{hash}", function(Request $request, $id, $hash) {
    $user = User::findOrFail($request->id);
    if($user->hasVerifiedEmail()) {
        return response()->json(["message" => "Ez az email már meg van erősítve."]);
    }
    $user->markEmailAsVerified();
    return response()->json(["message" => "Sikeres email megerősítés."]);
})->name("verification.verify")->middleware("signed");


