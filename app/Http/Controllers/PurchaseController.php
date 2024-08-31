<?php

namespace App\Http\Controllers;

use App\Services\BuyerService;
use App\Services\EventService;
use App\Services\PurchaseService;
use App\Services\TicketService;
use Config;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    
    public function purchase(
        Request $request, 
        BuyerService $buyerService, 
        PurchaseService $purchaseService
        )
    {
        try {
            $buyer = $buyerService->create($request->name, $request->email, $request->phone);
            $purchase = $purchaseService->create($request->tickets, $buyer);
            $purchaseService->sendMail($buyer->email, $buyer->name, $purchase['eventId'], $purchase['token'], $purchase['total'], $request->tickets, $purchase['tickets']);
            return response()->json([
                'success' => true, 
                'message' => 'Pembayaran berhasil diproses! Silahkan cek email kamu untuk melanjutkan proses pembayaran'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan. Silakan coba lagi. '. $th
            ], 500);
        }
    }

    public function pay(
        $eventId, $token,
        EventService $eventService,
        PurchaseService $purchaseService
        ){
        $event = $eventService->show($eventId);
        $purchases = $purchaseService->findWithToken($token);
        return view('purchase.index', compact('token', 'event', 'purchases'));
    }

    
}
