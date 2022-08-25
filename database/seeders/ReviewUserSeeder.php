<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Review;
use App\Models\User;

class ReviewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::all();
        
        // Review::all()->each(function ($review) use ($users) {
        //     $review->reviewsThat()
        //     ->associate($users->random());
        //     $review->reviewsWhom()
        //     ->associate($users->random());
            
        // });
         Review::factory()
         ->afterMaking(function ($review) use ($users) {
            $review->reviewsThat()->associate($users->random());
            $review->reviewsWhom()->associate($users->random());
            
        })
        ->count(30)
            ->create();
        
    }
}
