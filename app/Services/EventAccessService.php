<?php

namespace App\Services;

use App\Models\EventAccess;
use App\Models\Purchase;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class EventAccessService
{
    public function generate($purchases) {
        $purchaseId = [];
        foreach ($purchases as $purchase) {
            if ($purchase->status == 'paid' && $purchase->eventAccesses->isEmpty()) {
                for ($i = 1; $i <= $purchase->qty; $i++) {
                    $eventAccess = EventAccess::create([  
                        "purchase_id" => $purchase->id,
                        "qr" => "path",
                        "isEntry" => false,
                    ]);
                    $qrCode = QrCode::format('png')
                    ->size(300)
                    ->backgroundColor(255, 255, 244)
                    ->margin(3)
                    ->generate($eventAccess->id);
                    $fileName = $purchase->tickets->events->id."/".$eventAccess->id.".png";
                    Storage::put($fileName, $qrCode);
                    $eventAccess->qr = $fileName;
                    $eventAccess->save();
                }
            }
            $purchaseId[] = $purchase->id;
        }
        return EventAccess::whereIn('purchase_id', $purchaseId)->get();
    }

    public function generate_admin($jumlah, $ticketId) {
        $eventAccessId = [];
        $purchase = Purchase::create([
            'ticket_id' => $ticketId,
            'qty' => $jumlah,
            'token' => 'byAdmin',
            'status' => 'paid'
        ]);
        for ($i = 0; $i < $jumlah; $i++) {
            $eventAccess = EventAccess::create([  
                "purchase_id" => $purchase->id,
                "qr" => "path",
                "isEntry" => false,
            ]);
            $qrCode = QrCode::format('png')
            ->size(300)
            ->backgroundColor(255, 255, 244)
            ->margin(3)
            ->generate($eventAccess->id);
            $fileName = "admin/".$eventAccess->id.".png";
            Storage::put($fileName, $qrCode);
            $eventAccess->qr = $fileName;
            $eventAccess->save();

            $eventAccessId[] = $eventAccess->id;
        }
        return EventAccess::whereIn('id', $eventAccessId)->get();
    }
    
}