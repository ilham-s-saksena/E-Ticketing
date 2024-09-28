<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)->create();

        // $organizations = Organization::all();
        // foreach ($organizations as $org) {
        //     User::factory(1)->create([
        //         'organization_id' => $org->id
        //     ]);
        // }
    }
}
