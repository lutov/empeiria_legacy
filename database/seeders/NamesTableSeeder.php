<?php

namespace Database\Seeders;

use App\Models\Name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NamesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run() {

        $file = File::get(storage_path('app/seeders/names.txt'));
        $names = explode("\r\n", $file);
        foreach($names as $name) {
            Name::create(array('name' => $name));
        }

    }
}
