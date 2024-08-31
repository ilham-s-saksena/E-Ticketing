<?php
use App\Http\Controllers\EventAccessController;
use Illuminate\Support\Facades\Route;

Route::controller(EventAccessController::class)->prefix('eventaccess')
    ->group(function () {
        Route::get('/payment/{token}', 'eventaccess')->name('pay-success');
    });
