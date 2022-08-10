<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Location;

class LocationSeeder extends Seeder
{
    protected array $cities = [
        ['city' => 'Москва'],
        ['city' => 'Санкт-Петербург'],
        ['city' => 'Вологда'],
        ['city' => 'Ярославль'],
        ['city' => 'Сочи'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Location::upsert($this->cities, ['city'], ['city']);
    }
}
