<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Petsize;

class UserPetsizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $petSize = Petsize::all();

        User::all()->each(function ($user) use ($petSize) {
            for ($i=0; $i < rand(1, 3); $i++) { 
                $user->petSize()->attach($petSize[$i]);
            }
            
        });
    }
}
