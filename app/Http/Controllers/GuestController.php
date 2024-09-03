<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(
        Request $request,
        EventService $eventService
        ) {
        if (isset($request->search)) {
            $events = $eventService->search($request->search);
        } else {
            $events = $eventService->index(); 
        }   
        return view(
            'welcome2', 
            compact('events')
        );
    }
}
