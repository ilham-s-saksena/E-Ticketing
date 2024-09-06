<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->group(function () {
        Route::get('dashboard', 'users_dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
