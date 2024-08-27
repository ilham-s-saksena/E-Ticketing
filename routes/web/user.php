<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->group(function () {

        Route::prefix('/u')
            // ->middleware(['auth', 'user'])
            ->group(function(){
                Route::get('dashboard', 'user_dashboard');
        });

    });