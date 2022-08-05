<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
//    protected array $animals = [
//        ['name' => 'Кошка'],
//        ['name' => 'Собака'],
//        ['name' => 'Попугай'],
//        ['name' => 'Тритон'],
//        ['name' => 'Лягушка'],
//    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {
//        Animal::query()->upsert(
//            $this->animals,
//            ['name'],
//            ['name'],
//        );
        Animal::factory()
            ->count(1)
            ->for(User::factory()->count(1))
            ->for(Order::factory()->count(1))
            ->create();
    }
}
