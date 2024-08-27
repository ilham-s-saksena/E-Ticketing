<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        foreach ($events as $event) {
            Ticket::factory()->create([
                'event_id' => $event->id,
                'name' => "VVIP",
                'price' => 250000
            ]);
            Ticket::factory()->create([
                'event_id' => $event->id,
                'name' => "VIP",
                'price' => 125000
            ]);
        }
    }
}
