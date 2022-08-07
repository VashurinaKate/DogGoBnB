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
        $animals = Animal::all();

        User::all()->each(function ($user) use ($animals) {
            $user->animals()->syncWithPivotValues($animals->shuffle()->take(rand(1, 3)), [
                'amount' => rand(1, 3),
                'size' => collect(AnimalSizeEnum::cases())->pluck('value')->random(),
            ]);
        });
    }
}
