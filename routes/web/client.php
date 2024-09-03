<?php

use Illuminate\Support\Facades\Route;


Route::view('dashboard', 'users.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
