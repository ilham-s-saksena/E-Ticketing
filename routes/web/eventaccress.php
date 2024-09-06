<?php
use App\Http\Controllers\EventAccessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

Route::controller(EventAccessController::class)->prefix('eventaccess')
    ->group(function () {
        Route::get('/payment/{token}', 'eventaccess')->name('pay-success');
        Route::post('send-tickets', 'uploadTicketImage')->name('send-tickets');
        Route::post('/create/admin', 'create_admin')->name('eventaccess.admin');
    });


    Route::get('/qrcode/{path}/{filename}', function ($path, $filename) {
        $pathStor = storage_path('app/' .$path . '/' . $filename);
    
        if (!file_exists($pathStor)) {
            abort(403);
        }
    
        $fileContent = file_get_contents($pathStor);
        return new Response($fileContent, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    });
