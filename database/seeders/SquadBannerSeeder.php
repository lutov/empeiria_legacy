<?php

namespace Database\Seeders;

use App\Models\Squads\Banner;
use Illuminate\Database\Seeder;

class SquadBannerSeeder extends Seeder
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
        $handle = fopen(storage_path('app/seeders/squads_banners.csv'), "r");
        while ($row = fgetcsv($handle, $length, $delimiter)) {
            Banner::create(array('name' => $row[0]));
        }
        fclose($handle);
    }
}
