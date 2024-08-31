<?php

namespace App\Services;

use App\Models\EventAccess;

class EventAccessService
{
    public function generate($purchases) {
        $purchaseId = [];
        foreach ($purchases as $purchase) {
            if ($purchase->status == 'paid' && $purchase->eventAccesses->isEmpty()) {
                for ($i = 1; $i <= $purchase->qty; $i++) {
                    EventAccess::create([  
                        "purchase_id" => $purchase->id,
                        //need to generate Qr Code
                        "qr" => "path/to/qrcode.png",
                        "isEntry" => false,
                    ]);
                }
            }
            $purchaseId[] = $purchase->id;
        }
        return EventAccess::whereIn('purchase_id', $purchaseId)->get();
    }
    
}