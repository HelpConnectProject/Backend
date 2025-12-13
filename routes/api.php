<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\UserController;

Route::group([ "middleware" => [ "auth:sanctum" ]], function() {

    // User
    Route::post('/logout', [UserController::class, 'logout']);
});

// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);
Route::get('/users', [UserController::class, 'getUsers']);
