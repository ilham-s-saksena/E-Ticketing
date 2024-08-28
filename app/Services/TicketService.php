<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    public function findMore(array $tickets) {
        foreach ($tickets as $ticket_id => $amout) {
            $ticket[] = Ticket::find($ticket_id);
        }
        return $ticket;
    }
    
}