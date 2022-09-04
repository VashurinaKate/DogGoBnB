<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Petsize;
use Illuminate\Database\Seeder;
use App\Enums\AnimalSizeEnum;
class PetSizeSeeder extends Seeder
{
    protected array $petSizes = [
        ['pet_size' => 'mini'],
        ['pet_size' => 'small'],
        ['pet_size' => 'medium'],
        ['pet_size' => 'big'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Petsize::upsert($this->petSizes, ['pet_size'], ['pet_size']);
    }
}
