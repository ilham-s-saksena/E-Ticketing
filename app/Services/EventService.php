<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function index(){
        return Event::where('event_date', ">", now())->take(5)->get();
    }
}