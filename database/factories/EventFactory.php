<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => "Event ".fake()->name(),
            'description' => fake()->text(),
            'flyer' => "default.jpg",
            'place_name' => 'Gor '. fake()->name(),
            'place_address' => fake()->address(),
            'place_location' => json_encode([
                "longitude" => 109.01023,
                "latitude" => -7.918365
            ]),
            "guest_stars" => json_encode([fake()->name(), fake()->name(), fake()->name()]),
            "event_date" => now()->addDays(rand(10, 26)),
            "time_start" => now(),
            "time_end" => now()->addHours(10),
        ];
    }
}
