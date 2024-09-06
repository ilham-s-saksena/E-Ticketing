<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\EventService;
use App\Services\TicketService;
use Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function ticket(EventService $eventService)
    {
        $events= $eventService->getSelfEvent(Auth::user());
        return view('users.ticket', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ticket_form(
        Request $request,
        TicketService $ticketService
        )
    {
        $ticketService->create($request->all());
        return redirect()->back()->with('message', 'Ticket Created Successfuly');
    }

    public function ticket_delete($id, TicketService $ticketService){
        try {
            $ticketService->delete($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Ticket Can't be Deleted, There are already buyers there");
        }
        return redirect()->back()->with('message', "Success Delete Ticket");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
