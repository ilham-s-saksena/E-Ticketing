<?php

namespace App\Services;

use App\Models\Buyer;

class BuyerService
{
    public function create(
        string $name,
        string $email,
        int $phone
    ) {
        $buyer = Buyer::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'phone' => $phone
            ]
        );
        
        return $buyer;
    }
    
}