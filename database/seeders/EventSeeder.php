<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = Organization::all();
        foreach ($organizations as $org) {
            Event::factory(5)->create([
                "organization_id" => $org->id
            ]);
        }
    }
}
