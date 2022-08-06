<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Enums\AnimalSizeEnum;

use App\Models\User;
use App\Models\Animal;

class AnimalRecipientSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->hasAttached(
                Animal::factory(3),
                [
                    'amount' => rand(1, 3),
                    'size' => collect(AnimalSizeEnum::cases())->pluck('value')->random(),
                ]
            )
            ->count(5)
            ->create();
    }
}
