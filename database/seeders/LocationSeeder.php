<?php
declare(strict_types=1);

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    protected array $cities = [
        ['name' => 'Москва'],
        ['name' => 'Санкт-Петербург'],
        ['name' => 'Вологда'],
        ['name' => 'Ярославль'],
        ['name' => 'Сочи'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('city')->insert($this->cities, ['name'], ['name']);
    }
}
