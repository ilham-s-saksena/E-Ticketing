<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use App\Services\TicketService;
use Auth;
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

    public function event(EventService $eventService)
    {
        $events = $eventService->getSelfEvent(Auth::user());
        return view('users.event', compact('events'));
    }

    public function event_create(){
        return view('users.createEvent');
    }

    public function event_form(
        Request $request,
        EventService $eventService
    ){
        // dd(request()->all());
        if (!isset($request->guest_stars)) {
            return redirect()->back()->with('error', 'guest stars must be filled');
        }
        $eventService->create($request->all(), Auth::user());
        return redirect()->route('event')->with('message', 'Event Successfuly Created');
    }
    
}
