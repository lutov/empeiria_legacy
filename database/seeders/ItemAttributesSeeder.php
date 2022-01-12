<?php

namespace Database\Seeders;

use App\Models\Items\Attribute;
use Illuminate\Database\Seeder;

class ItemAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = array(
            array(
                'name' => 'Sharp',
                'description' => '',
            ),
            array(
                'name' => 'Dull',
                'description' => '',
            ),
            array(
                'name' => 'Brittle',
                'description' => '',
            ),
        );
        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }
    }
}
