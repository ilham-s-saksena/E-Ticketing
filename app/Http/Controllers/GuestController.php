<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(EventService $eventService) {
        $events = $eventService->index(); 
        return view('welcome', compact('events'));
    }
}
