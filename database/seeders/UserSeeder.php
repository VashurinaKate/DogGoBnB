<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->count(30)->create();
    }
}
