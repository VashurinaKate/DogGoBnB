<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Animal;

class AnimalOrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()
            ->has(Animal::factory(2))
            ->count(10)
            ->create();
    }
}
