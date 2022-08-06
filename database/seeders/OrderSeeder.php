<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Order::factory()->count(35)->create();
    }
}
