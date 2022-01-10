<?php

namespace Database\Seeders;

use App\Models\Characters\Avatar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CharactersAvatarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get(storage_path('app/seeders/avatars_male.txt'));
        $names = explode("\n", $file);
        foreach ($names as $name) {
            Avatar::create(array('name' => $name, 'gender_id' => 2));
        }
        $file = File::get(storage_path('app/seeders/avatars_female.txt'));
        $names = explode("\n", $file);
        foreach ($names as $name) {
            Avatar::create(array('name' => $name, 'gender_id' => 3));
        }
    }
}
