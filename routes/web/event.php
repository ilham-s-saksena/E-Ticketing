<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::controller(EventController::class)->prefix('event')
    ->group(function () {
        Route::get('{id}', 'index');
        Route::post('checkout', 'checkout')->name('checkout');
    });
