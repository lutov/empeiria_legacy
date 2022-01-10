<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Character\Avatar;
use App\Models\Character\Gender;
use App\Models\Character\Inventory;
use App\Models\Character\Quality;
use App\Models\Faction;
use App\Models\Name;
use App\Models\Reference\Qualities;
use App\Models\Squad;
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
        $userId = 1;
        $character = new Character();
        $gender = Gender::random();
        $faction = Faction::find(1);
        $squad = Squad::find(1);
        $qualities = Qualities::all();
        $character->user_id = $userId;
        $character->name = Name::random(['first_name' => 1, $gender->slug => 1]);
        $character->nickname = Name::random(['nickname' => 1, $gender->slug => 1]);
        $character->last_name = Name::random(['last_name' => 1, $gender->slug => 1]);
        $character->age = rand(18, 100);
        $character->bio = '';
        $character->gender_id = $gender->id;
        $character->avatar_id = Avatar::random($gender)->id;
        $character->faction_id = $faction->id;
        $character->faction_order = 1;
        $character->squad_id = $squad->id;
        $character->squad_order = 1;
        $character->save();
        $characterQualities = array(
            'character_id' => $character->id,
        );
        foreach ($qualities as $quality) {
            $characterQualities[$quality->slug] = rand(1, 10);
        }
        Quality::create($characterQualities);
        $inventory = new Inventory();
        $inventory->character_id = $character->id;
        $inventory->save();
    }
}
