<?php

namespace Database\Seeders;

use App\Models\Items\Parameter;
use Illuminate\Database\Seeder;

class ItemParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parameters = array(
            array(
                'name' => 'Damage',
            ),
            array(
                'name' => 'Armor',
            ),
            array(
                'name' => 'Weight',
            ),
        );
        foreach ($parameters as $parameter) {
            Parameter::create($parameter);
        }
    }
}
