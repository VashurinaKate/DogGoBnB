<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::all();

        Order::factory()
            ->afterMaking(function (Order $order) use ($users) {
                $order->owner()->associate($users->random());
                $order->recipient()->associate($users->random());
            })
            ->count(35)
            ->create();
    }
}
