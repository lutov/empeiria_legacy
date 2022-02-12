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
        $handle = fopen(storage_path('app/seeders/items.csv'), "r");
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
            "Battle axe" => ["attributes" => []],
            "Club" => ["attributes" => []],
            "Flail" => ["attributes" => []],
            "Mace" => ["attributes" => []],
            "Morning star" => ["attributes" => []],
            "Quarterstaff" => ["attributes" => []],
            "Pernach" => ["attributes" => []],
            "War hammer" => ["attributes" => []],

            "Arming sword" => ["attributes" => []],
            "Dagger" => ["attributes" => []],
            "Estoc" => ["attributes" => []],
            "Falchion" => ["attributes" => []],
            "Katana" => ["attributes" => []],
            "Knife" => ["attributes" => []],
            "Longsword" => ["attributes" => []],
            "Rapier" => ["attributes" => []],
            "Saber" => ["attributes" => []],
            "Shortsword" => ["attributes" => []],

            "Ahlspiess" => ["attributes" => []],
            "Bardiche" => ["attributes" => []],
            "Bill" => ["attributes" => []],
            "Glaive" => ["attributes" => []],
            "Goedendag" => ["attributes" => []],
            "Guisarme" => ["attributes" => []],
            "Halberd" => ["attributes" => []],
            "Lance" => ["attributes" => []],
            "Military fork" => ["attributes" => []],
            "Partisan" => ["attributes" => []],
            "Pike" => ["attributes" => []],
            "Ranseur" => ["attributes" => []],
            "Sovnya" => ["attributes" => []],
            "Spetum" => ["attributes" => []],
            "Swordstaff" => ["attributes" => []],
            "Voulge" => ["attributes" => []],
            "War scythe" => ["attributes" => []],

            "Longbow" => ["attributes" => []],
            "Recurved bow" => ["attributes" => []],
            "Short bow" => ["attributes" => []],
            "Crossbow" => ["attributes" => []],

            "Gambeson" => ["attributes" => []],
            "Lamellar armour" => ["attributes" => []],
            "Laminar armour" => ["attributes" => []],
            "Scale armour" => ["attributes" => []],
            "Chain mail" => ["attributes" => []],
            "Hauberk" => ["attributes" => []],
            "Mail and plate armour" => ["attributes" => []],
            "Coat of plates" => ["attributes" => []],
            "Brigandine" => ["attributes" => []],
            "Jack of plate" => ["attributes" => []],
            "Splint armour" => ["attributes" => []],
            "Mirror armour" => ["attributes" => []],
            "Breastplate" => ["attributes" => []],
            "Plate armour" => ["attributes" => []],
            "Boiled leather" => ["attributes" => []],
        );
    }
}
