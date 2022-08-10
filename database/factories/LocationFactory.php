<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Location;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    protected array $cities = [
        'Москва',
        'Санкт-Петербург',
        'Вологда',
        'Ярославль',
        'Сочи',
    ];

    public function definition(): array
    {
        return [
            'city' => \Arr::random($this->cities),
        ];
    }
}
