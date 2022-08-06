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
            'email_verified_at' => now(),
            'password' => \Hash::make('kate@gmail.com'),
            'role' => 10,
        ]);

        User::factory()->count(30)->create();
    }
}
