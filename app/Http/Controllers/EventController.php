<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index($id, EventService $eventService)
    {
        $event = $eventService->show($id);
        return view('event.index', compact('event'));
    }

    public function checkout(Request $request, TicketService $ticketService, EventService $eventService) {
        $ticketOrder = $request->amountTicket;
        $tickets = $ticketService->findMore($ticketOrder);
        
        return view('event.checkout', compact('tickets', 'ticketOrder'));
    }

    
}
