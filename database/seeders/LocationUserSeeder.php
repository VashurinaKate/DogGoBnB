<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Location;

class LocationUserSeeder extends Seeder
{
    public function run()
    {
        $locations = Location::all();

        User::all()->each(function ($user) use ($locations) {
            $user->locations()->attach($locations->random());
        });
    }
}
