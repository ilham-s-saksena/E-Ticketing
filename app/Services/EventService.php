<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function index(){
        return Event::where('event_date', ">", now())->take(5)->get();
    }

    public function search(string $search){
        return Event::where('event_date', ">", now())->whereAny(['name', 'description', 'place_name', 'guest_stars'], 'like', "%$search%")->take(10)->get();
    }

    public function show($id){
        $event = Event::find($id);
        return $event;
    }
}