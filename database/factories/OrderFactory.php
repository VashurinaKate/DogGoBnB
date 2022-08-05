<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => fake()->numberBetween(1, 30),
            'recipient_id' => fake()->numberBetween(1, 30),
            'comment' => fake()->text(250),
            'status' => fake()->numberBetween(-1, 2),
            'start_date' => fake()->dateTimeBetween('now', '+5 months'),
            'end_date' => fake()->dateTimeBetween('now', '+5 months'),
        ];
    }
}
