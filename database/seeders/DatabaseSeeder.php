<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AnimalSeeder::class,
            OrderSeeder::class,
            AnimalOrderSeeder::class,
            AnimalRecipientSeeder::class,
            LocationSeeder::class,
            LocationUserSeeder::class,
            ReviewSeeder::class,
            // ReviewUserSeeder::class,
        ]);
    }
}
