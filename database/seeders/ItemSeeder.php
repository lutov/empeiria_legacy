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
    }
}
