<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Animal;

class AnimalOrderSeeder extends Seeder
{
    public function run()
    {
        $animals = Animal::all();

        Order::all()->each(function ($order) use ($animals) {
            $order->animals()->sync($animals->shuffle()->take(rand(1, 3)));
        });
    }
}
