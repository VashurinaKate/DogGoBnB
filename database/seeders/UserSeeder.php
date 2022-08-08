<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kate',
            'email' => 'kate@gmail.com',
            'phone' => '+79201234567',
            'email_verified_at' => now(),
            'password' => 'kate@gmail.com',
            'role' => 10,
        ]);

        User::factory()->count(30)->create();
    }
}
