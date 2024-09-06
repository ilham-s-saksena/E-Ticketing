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

    public function getSelfEvent($user) {
        $events = Event::where('organization_id', $user->organization_id)->get();
        return $events;
    }

    public function create($data, $user){
        // dd(json_encode($data['guest_stars']));
        $eventFlyer = time() . '_' . uniqid() . '.' . $data['flyer']->getClientOriginalExtension();
        $data['flyer']->move('event_img', $eventFlyer);

        Event::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'flyer' => "/event_img/".$eventFlyer,
            'place_name' => $data['place_name'],
            'place_address' => $data['place_address'],
            'place_location' => json_encode($data['place_location']),
            'guest_stars' => json_encode($data['guest_stars']),
            'event_date' => date_create_from_format("m/d/Y", $data['date']) ,
            'time_start' => $data['event_start'],
            'time_end' => $data['event_end'],
            'organization_id' => $user->organization_id
        ]);
    }
}