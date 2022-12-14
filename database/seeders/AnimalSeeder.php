<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    protected array $animals = [
        ['name' => 'Кошка'],
        ['name' => 'Собака'],
        ['name' => 'Попугай'],
        ['name' => 'Тритон'],
        ['name' => 'Лягушка'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Animal::query()->upsert($this->animals, ['name'], ['name']);
    }
}
