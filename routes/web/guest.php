<?php
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::controller(GuestController::class)
    ->group(function () {
        Route::get('/', 'index');

    });
// Route::get('/', function () {
//     return view('welcome');
// });
