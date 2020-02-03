<?php

use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $types = array(
            array(
                'name' => 'Weapon',
                'description' => 'A tool to inflict damage',
                'model' => 'App\Models\Items\Weapon',
                'parent_id' => null,
            ),
            array(
                'name' => 'Sword',
                'description' => 'Common type of a melee weapon usually with long blade and relatively short handle',
                'model' => 'App\Models\Items\Weapons\Sword',
                'parent_id' => 'Weapon',
            ),
            array(
                'name' => 'Axe',
                'description' => 'Common type of a melee weapon usually with middle-size or long handle and relatively heavy short blade',
                'model' => 'App\Models\Items\Weapons\Axe',
                'parent_id' => 'Weapon',
            ),
            array(
                'name' => 'Spear',
                'description' => 'Common type of a melee weapon usually with very long handle and short pointy blade',
                'model' => 'App\Models\Items\Weapons\Spear',
                'parent_id' => 'Weapon',
            ),
            array(
                'name' => 'Mace',
                'description' => 'Common type of a melee weapon usually heavy with middle-size handle and some sort of a striking head',
                'model' => 'App\Models\Items\Weapons\Mace',
                'parent_id' => 'Weapon',
            ),
            array(
                'name' => 'Armor',
                'description' => 'An equipment to protect from damage',
                'model' => 'App\Models\Items\Armor',
                'parent_id' => null,
            ),
            array(
                'name' => 'Helmet',
                'description' => 'Basically any type of headgear',
                'model' => 'App\Models\Items\Armor\Helmet',
                'parent_id' => 'Armor',
            ),
        );

        foreach($types as $key => $values) {
            $values['parent_id'] = ItemType::select('id')->where('name', $values['parent_id'])->limit('1')->value('id');
            $item_type = ItemType::create($values);
        }

    }
}
