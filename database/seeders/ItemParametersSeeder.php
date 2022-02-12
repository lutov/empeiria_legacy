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
            ['name' => 'Damage', "attributes" => ['weapon']],
            ['name' => 'Armor', "attributes" => ['armor', 'shield']],
            ['name' => 'Weight', "attributes" => []],
        );
        foreach ($parameters as $parameter) {
            Parameter::create($parameter);
        }
    }
}
