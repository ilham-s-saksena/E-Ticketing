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

    public function find($ticket_id){
        return Ticket::find($ticket_id);
    }

    public function create($data){
        Ticket::create([
            'name' => $data['name'],
            'price' => str_replace('.', '',$data['price']),
            'description' => $data['description'],
            'discount' => 0,
            'event_id' => $data['event_id']
        ]);
    }

    public function delete($id){
        $ticket = Ticket::find($id);
        $ticket->delete();
    }
    
}