<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::controller(EventController::class)->prefix('event')
    ->group(function () {
        Route::get('{id}', 'index');
        Route::post('checkout', 'checkout')->name('checkout');

        Route::middleware(['isAdmin', 'organization'])->prefix('admin')->group(function(){
            Route::get('event', 'event')->name('event');
            Route::get('event/create', 'event_create')->name('event.create');
            Route::post('event/create/form', 'event_form')->name('event.form');
        });
    });
