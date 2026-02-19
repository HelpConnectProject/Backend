<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/change-password', [ChangePasswordController::class, 'show'])->name('password.reset.form');
Route::post('/change-password', [ChangePasswordController::class, 'submit'])->name('password.reset.submit');
