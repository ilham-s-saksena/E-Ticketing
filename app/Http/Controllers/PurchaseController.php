<?php

namespace App\Http\Controllers;

use App\Services\BuyerService;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    
    public function purchase(
        Request $request, 
        BuyerService $buyerService, 
        PurchaseService $purchaseService
        )
    {
        $buyer = $buyerService->create($request->name, $request->email, $request->phone);
        $purchaseService->create($request->tickets, $buyer->id, $request->input('payment-method'));
        
        $purchaseService->sendMail($buyer->email, $buyer->name);
        
        dd($request->all());
    }

    
}
