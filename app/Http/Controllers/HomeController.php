<?php

namespace App\Http\Controllers;

use App\Helpers\ColorHelper;
use App\Models\Name;
use App\Models\World\Region;
use App\Models\World\Tile;
use App\Properties\Color;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        //Cache::remember('laravel:categories', 30, function() {return 'redis';});
        //$data = Redis::set('laravel:categories', 'redis');
        //$data = Redis::get('laravel:categories');
        //dd($data);

        return view('home', array());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Factory|View
     */
    public function world(Request $request, int $id = 0)
    {
        /*
        $debug = array();

        $color1 = new Color();
        $color1->makeRandom();
        $debug['color1'] = $color1->getHex();

        $color2 = new Color();
        $color2->makeRandom();
        $debug['color20'] = $color2->getHex();

        $tint = new Color(ColorHelper::tint($color->getArray()));
        $debug['tint'] = $tint->getHex();

        $tone = new Color(ColorHelper::tone($color->getArray()));
        $debug['tone'] = $tone->getHex();

        $shade = new Color(ColorHelper::shade($color->getArray()));
        $debug['shade'] = $shade->getHex();

        $max = 10;
        $c1 = $color1->getArray();
        $c2 = $color2->getArray();
        for($i = 0; $i < $max; $i++) {
            //echo '<p>c1 = '.print_r($c1, 1).'</p>';
            $c3 = new Color(ColorHelper::mix($c1, $c2, (($max - $i) / 10)));
            $debug['color1'.$i] = $c3->getHex();
            $c1 = $c3->getArray();
        }

        ksort($debug);

        foreach($debug as $key => $value) {
            echo '<div style="width: 100px; height: 100px; background-color: '.$value.'">'.$key.' - '.$value.'</div>';
        }

        dd($debug);
        */

        $map = array();

        $world_size_y = 3;
        $world_size_x = 12;

        $region_size_y = 12;
        $region_size_x = 12;

        for ($row = 0; $row < $world_size_y; $row++) {
            for ($col = 0; $col < $world_size_x; $col++) {

                $region = new Region();

                $region->name = Name::random();

                $color = new Color();
                $region->color = $color->getHex();

                $tiles = array();

                for ($y = 0; $y < $region_size_y; $y++) {
                    for ($x = 0; $x < $region_size_x; $x++) {
                        $tile = new Tile();
                        $tile->region_id = $region->id;
                        $tile->local_y = $y;
                        $tile->local_x = $x;
                        $tile->global_y = $row + $y;
                        $tile->global_x = $col + $x;
                        $tile->color = $color->getHex();

                        $tiles[$y][$x] = $tile;

                        $c1 = $color->getArray();
                        $color = new Color();
                        $c2 = $color->getArray();
                        $color = new Color(ColorHelper::mix($c1, $c2));

                        /*
                        $mods = array(0 => 'tint', 1 => 'tone', 2 => 'shade');
                        $mod = $mods[rand(0, 1)];
                        $color = new Color(ColorHelper::$mod($color->getArray()));
                        */
                    }
                }

                $region->tiles = $tiles;

                $map[$row][$col] = $region;

            }
        }

        //dd($map);

        echo '<div style="border: 0px solid black;">';
        for ($row = 0; $row < $world_size_y; $row++) {
            echo '<div class="row no-gutters">';
            for ($col = 0; $col < $world_size_x; $col++) {
                echo '<div class="col-1" style="border: 0px solid grey;">';
                for ($y = 0; $y < $region_size_y; $y++) {
                    echo '<div class="row no-gutters">';
                    for ($x = 0; $x < $region_size_x; $x++) {
                        echo '<div class="col-1" style="background-color: ' . $map[$row][$col]->tiles[$y][$x]->color . '; height: 10px;">';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
        //echo '<div style="width: 100px; height: 100px; background-color: '.$value.'">'.$key.' - '.$value.'</div>';

        return view('world', array(
            'id' => $id,
        ));
    }
}
