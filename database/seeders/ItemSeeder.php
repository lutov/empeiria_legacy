<?php

namespace Database\Seeders;

use App\Models\Items\Attribute;
use App\Models\Items\Item;
use App\Models\Items\Parameter;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = 1000;
        $delimiter = ',';
        $handle = fopen(storage_path('app/seeders/items.csv'), 'r');
        $headers = fgetcsv($handle, $length, $delimiter);
        while ($row = fgetcsv($handle, $length, $delimiter)) {
            $name = array_combine($headers, $row);
            $item = Item::create($name);
            $parameters = Parameter::all(); // TODO filter parameters
            foreach ($parameters as $parameter) {
                $item->parameters()->attach($parameter->id, ['value' => rand($parameter->min, $parameter->max)]);
            }
            $attributes = Attribute::all(); // TODO filter attributes
            foreach ($attributes as $attribute) {
                $item->attributes()->attach($attribute->id);
            }
        }
        fclose($handle);

        $items = array(
            'Battle axe' => [
                'parameters' => [
                    'damage' => '8',
                    'anti-armor' => '6',
                    'durability' => '6',
                    'speed' => '6',
                    'reach' => '5',
                    'defense' => '3',
                    'universality' => '5',
                    'complexity' => '3',
                ],
                'attributes' => ['weapon', 'one-handed', 'sharp', 'short']
            ],
            'Club' => [
                'parameters' => [
                    'damage' => '6',
                    'anti-armor' => '6',
                    'durability' => '8',
                    'speed' => '6',
                    'reach' => '5',
                    'defense' => '4',
                    'universality' => '5',
                    'complexity' => '2',
                ],
                'attributes' => ['weapon', 'one-handed', 'dull', 'short']
            ],
            'Flail' => ['parameters' => [], 'attributes' => []],
            'Mace' => ['parameters' => [], 'attributes' => []],
            'Morning star' => ['parameters' => [], 'attributes' => []],
            'Quarterstaff' => ['parameters' => [], 'attributes' => []],
            'Pernach' => ['parameters' => [], 'attributes' => []],
            'War hammer' => ['parameters' => [], 'attributes' => []],

            'Arming sword' => ['parameters' => [], 'attributes' => []],
            'Dagger' => ['parameters' => [], 'attributes' => []],
            'Estoc' => ['parameters' => [], 'attributes' => []],
            'Falchion' => ['parameters' => [], 'attributes' => []],
            'Katana' => ['parameters' => [], 'attributes' => []],
            'Knife' => ['parameters' => [], 'attributes' => []],
            'Longsword' => ['parameters' => [], 'attributes' => []],
            'Rapier' => ['parameters' => [], 'attributes' => []],
            'Saber' => ['parameters' => [], 'attributes' => []],
            'Shortsword' => ['parameters' => [], 'attributes' => []],

            'Ahlspiess' => ['parameters' => [], 'attributes' => []],
            'Bardiche' => ['parameters' => [], 'attributes' => []],
            'Bill' => ['parameters' => [], 'attributes' => []],
            'Glaive' => ['parameters' => [], 'attributes' => []],
            'Goedendag' => ['parameters' => [], 'attributes' => []],
            'Guisarme' => ['parameters' => [], 'attributes' => []],
            'Halberd' => ['parameters' => [], 'attributes' => []],
            'Lance' => ['parameters' => [], 'attributes' => []],
            'Military fork' => ['parameters' => [], 'attributes' => []],
            'Partisan' => ['parameters' => [], 'attributes' => []],
            'Pike' => ['parameters' => [], 'attributes' => []],
            'Ranseur' => ['parameters' => [], 'attributes' => []],
            'Sovnya' => ['parameters' => [], 'attributes' => []],
            'Spetum' => ['parameters' => [], 'attributes' => []],
            'Swordstaff' => ['parameters' => [], 'attributes' => []],
            'Voulge' => ['parameters' => [], 'attributes' => []],
            'War scythe' => ['parameters' => [], 'attributes' => []],

            'Longbow' => ['parameters' => [], 'attributes' => []],
            'Recurved bow' => ['parameters' => [], 'attributes' => []],
            'Short bow' => ['parameters' => [], 'attributes' => []],
            'Crossbow' => ['parameters' => [], 'attributes' => []],

            'Gambeson' => ['parameters' => [], 'attributes' => []],
            'Lamellar armour' => ['parameters' => [], 'attributes' => []],
            'Laminar armour' => ['parameters' => [], 'attributes' => []],
            'Scale armour' => ['parameters' => [], 'attributes' => []],
            'Chain mail' => ['parameters' => [], 'attributes' => []],
            'Hauberk' => ['parameters' => [], 'attributes' => []],
            'Mail and plate armour' => ['parameters' => [], 'attributes' => []],
            'Coat of plates' => ['parameters' => [], 'attributes' => []],
            'Brigandine' => ['parameters' => [], 'attributes' => []],
            'Jack of plate' => ['parameters' => [], 'attributes' => []],
            'Splint armour' => ['parameters' => [], 'attributes' => []],
            'Mirror armour' => ['parameters' => [], 'attributes' => []],
            'Breastplate' => ['parameters' => [], 'attributes' => []],
            'Plate armour' => ['parameters' => [], 'attributes' => []],
            'Boiled leather' => ['parameters' => [], 'attributes' => []],
        );
    }
}
