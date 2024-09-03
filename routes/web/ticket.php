<?php
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::controller(TicketController::class)->prefix('ticket')
    ->group(function () {
        
        Route::middleware(['isAdmin', 'organization'])->group(function(){
            Route::get('/', 'ticket')->name('ticket');
        });
    });
