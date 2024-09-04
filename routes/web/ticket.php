<?php
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::controller(TicketController::class)->prefix('ticket')
    ->group(function () {
        
        Route::middleware(['isAdmin', 'organization'])->group(function(){
            Route::get('/', 'ticket')->name('ticket');
            Route::post('/form', 'ticket_form')->name('ticket.form');
            Route::get('/delete/{id}', 'ticket_delete')->name('ticket.delete');
        });
    });
