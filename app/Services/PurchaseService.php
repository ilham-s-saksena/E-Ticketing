<?php

namespace App\Services;

use App\Models\Purchase;
use App\Mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;

class PurchaseService
{
    public function create(
        array $tickets,
        string $buyer_id,
        string $paymentMethod
    ) {
        foreach ($tickets as $ticket_id => $qty) {
            Purchase::create([
                'ticket_id' => $ticket_id,
                'buyer_id' => $buyer_id,
                'qty' => $qty,
                'payment_gateway' => $paymentMethod, // - need to remove with real payment gateway later 
            ]); 
        }

    }
    
    public function sendMail(string $email, string $name) {
        $messageContent = "This is a notification email to inform you about the recent updates.";

        Mail::to($email)->send(new UserNotificationMail($name, $messageContent));

        return "Email sent successfully!";
    }
    
}