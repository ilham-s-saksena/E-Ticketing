<?php
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::controller(OrganizationController::class)->prefix('organization')
    ->group(function () {
        
        Route::middleware('isAdmin')->group(function(){
            Route::get('/', 'organization')->name('organization');
            Route::post('/form', 'organization_form')->name('organization.form');
        });
    });
