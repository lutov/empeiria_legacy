<?php

namespace Database\Seeders;

use App\Models\Character\Quality;
use Illuminate\Database\Seeder;

class DemoCharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO create demo Character here
        $qualities = array(
            array(
                'character_id' => '1',
                'appeal' => '5',
                'vitality' => '9',
                'intellect' => '6',
                'sociality' => '5',
                'mobility' => '8',
                'willpower' => '6',
            ),
        );
        foreach ($qualities as $quality) {
            Quality::create($quality);
        }
    }
}
