<?php

namespace App\Services;

use App\Models\Buyer;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;

class PurchaseService
{
    public function create(
        array $tickets,
        Buyer $buyer,
    ) {
        \Midtrans\Config::$serverKey = Config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $ticketIds = array_keys($tickets);

        $getTicket = Ticket::whereIn('id', $ticketIds)->get();
        $totalPrice = 0;
        foreach ($getTicket as $ticket) {
            $ticketId = $ticket->id;
            $qty = $tickets[$ticketId];
            $totalPrice += $qty * $ticket->price;
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $totalPrice,
            ),
            
            "customer_details" => array(
                "first_name" => $buyer->name,
                "email" => $buyer->email
            )
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        foreach ($tickets as $ticket_id => $qty) {
            Purchase::create([
                'ticket_id' => $ticket_id,
                'buyer_id' => $buyer->id,
                'qty' => $qty,
                'token' => $snapToken
            ]);
        }

        return [
            "token" => $snapToken,
            "eventId" => $getTicket->first()->events->id,
            "total" => $totalPrice,
            "tickets" => $getTicket
        ];

    }
    
    public function sendMail(
        string $email,
        string $name,
        string $eventId,
        string $token,
        $total,
        $order,
        $tickets,
    ) {
        Mail::to($email)->send(new UserNotificationMail($name, $email, $eventId, $token, $total, $order, $tickets));
    }

    public function findWithToken($token){
        return Purchase::where('token',$token)->get();
    }

    public function updatePaidPurchases($purchases){
        foreach ($purchases as $purchase) {
            $purchase->status = 'paid';
            $purchase->save();
        }
    }

    public function updateSendedTicket($purchaseId){
        $purchase = Purchase::find($purchaseId);
        $purchase->isSended = true;
        $purchase->save();
    }
    
}