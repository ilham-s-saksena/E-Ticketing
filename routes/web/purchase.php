<?php
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::controller(PurchaseController::class)->prefix('purchase')
    ->group(function () {
        Route::post('/', 'purchase')->name('purchase');
    });
