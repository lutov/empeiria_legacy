<?php


namespace App\Helpers;


use App\Models\Name;
use App\Models\World\Region;
use App\Models\World\Tile;

class MapHelper
{

    /**
     * @var array
     */
    public static array $areas = array(
        'mainland' => array(
            array('colors' => array('green', 'green'), 'weight' => 100),
            array('colors' => array('green', 'orange'), 'weight' => 75),
            array('colors' => array('green', 'yellow'), 'weight' => 50),
            array('colors' => array('green', 'blue'), 'weight' => 25),
        ),
        'rural' => array(
            array('colors' => array('green', 'orange'), 'weight' => 100),
            array('colors' => array('orange', 'yellow'), 'weight' => 75),
            array('colors' => array('green', 'blue'), 'weight' => 50),
            array('colors' => array('blue', 'yellow'), 'weight' => 25),
        ),
        'borderland' => array(
            array('colors' => array('green', 'red'), 'weight' => 100),
            array('colors' => array('green', 'purple'), 'weight' => 75),
            array('colors' => array('orange', 'blue'), 'weight' => 50),
            array('colors' => array('blue', 'purple'), 'weight' => 25),
        ),
        'frontier' => array(
            array('colors' => array('red', 'red'), 'weight' => 100),
            array('colors' => array('red', 'orange'), 'weight' => 75),
            array('colors' => array('red', 'blue'), 'weight' => 50),
            array('colors' => array('red', 'purple'), 'weight' => 25),
        ),
    );

    /**
     * @param int $world_size_y
     * @param int $world_size_x
     * @param int $region_size_y
     * @param int $region_size_x
     * @return array
     */
    public static function generate(
        int $world_size_y = 12,
        int $world_size_x = 12,
        int $region_size_y = 12,
        int $region_size_x = 12
    ) {
        $map = array();
        $region_id = 1;
        $region_area = self::regions();
        for ($row = 0; $row < $world_size_y; $row++) {
            for ($col = 0; $col < $world_size_x; $col++) {
                $region = new Region();
                $region->id = $region_id;
                $region->name = Name::random();
                $picker = new RandomHelper();
                $area = self::$areas[$region_area[$row][$col]];
                foreach ($area as $element) {
                    $picker->addElement($element['colors'], $element['weight']);
                }
                $hue = 'monochrome';
                $luminosity = 'light';
                try {
                    $hue = $picker->getRandomElement();
                } catch (\Exception $e) {
                    dump($e->getMessage());
                }
                $color = ColorHelper::one(array('luminosity' => $luminosity, 'hue' => $hue));
                $region->color = $color;
                // save region
                $tiles = array();
                for ($y = 0; $y < $region_size_y; $y++) {
                    $colors = ColorHelper::many($region_size_x, array('luminosity' => $luminosity, 'hue' => $hue));
                    for ($x = 0; $x < $region_size_x; $x++) {
                        $tile = new Tile();
                        $tile->region_id = $region->id;
                        $tile->local_y = $y;
                        $tile->local_x = $x;
                        $tile->global_y = $row + $y;
                        $tile->global_x = $col + $x;
                        $tile->color = $colors[$x];
                        $tiles[$y][$x] = $tile;
                        // save tile
                    }
                }
                $region->tiles = $tiles;
                $map[$row][$col] = $region;
                $region_id++;
            }
        }
        //dd($map);
        return $map;
    }

    /**
     * @param array $map
     * @param int $world_id
     */
    public static function draw(array $map, int $world_id)
    {
        $world_size_y = count($map);
        $world_size_x = count($map[0]);
        $region_size_y = count($map[0][0]->tiles);
        $region_size_x = count($map[0][0]->tiles[0]);
        $tile_size_y = 12;
        $tile_size_x = 12;
        $region_full_size_x = ($region_size_x * $tile_size_x);
        $region_full_size_y = ($region_size_y * $tile_size_y);
        $world_full_size_x = ($world_size_x * $region_full_size_x);
        $world_full_size_y = ($world_size_y * $region_full_size_y);
        $world = imagecreatetruecolor($world_full_size_x, $world_full_size_y);
        $dst_y = 0;
        for ($row = 0; $row < $world_size_y; $row++) {
            $dst_x = 0;
            for ($col = 0; $col < $world_size_x; $col++) {
                $region = imagecreatetruecolor($region_full_size_x, $region_full_size_y);
                $y1 = 0;
                for ($y = 0; $y < $region_size_y; $y++) {
                    $x1 = 0;
                    $y2 = $y1 + ($tile_size_y - 1);
                    for ($x = 0; $x < $region_size_x; $x++) {
                        $x2 = $x1 + ($tile_size_x - 1);
                        $rgb = ColorHelper::hex2rgb($map[$row][$col]->tiles[$y][$x]->color);
                        $color = imagecolorallocate($region, $rgb[0], $rgb[1], $rgb[2]);
                        //dd($region, $x1, $y1, $x2, $y2, $color);
                        imagefilledrectangle($region, $x1, $y1, $x2, $y2, $color);
                        $x1 = $x2 + 1;
                    }
                    $y1 = $y2 + 1;
                }
                imagecopy($world, $region, $dst_x, $dst_y, 0, 0, $region_full_size_x, $region_full_size_y);
                $path = 'img/worlds/' . $world_id . '/map/regions/' . $map[$row][$col]->id . '.png';
                imagepng($region, public_path($path));
                imagedestroy($region);
                $dst_x += $region_full_size_x;
            }
            $dst_y += $region_full_size_y;
        }
        //imagefilter($world, IMG_FILTER_GAUSSIAN_BLUR);
        //imagefilter($world, IMG_FILTER_PIXELATE, 5);
        $path = 'img/worlds/' . $world_id . '/map/map.jpg';
        imagejpeg($world, public_path($path));
        imagedestroy($world);
    }

    /**
     * @param array $map
     * @param int $world_id
     * @return string
     */
    public static function render(array $map, int $world_id)
    {
        $html = '';
        $world_size_y = count($map);
        $world_size_x = count($map[0]);
        $region_size_y = count($map[0][0]->tiles);
        $region_size_x = count($map[0][0]->tiles[0]);
        $html .= '<div style="border: 0px solid black;">';
        for ($row = 0; $row < $world_size_y; $row++) {
            $html .= '<div class="row no-gutters">';
            for ($col = 0; $col < $world_size_x; $col++) {
                $url = '\'/public/img/worlds/' . $world_id . '/map/regions/' . $map[$row][$col]->id . '.png\'';
                $html .= '<div class="col-1" style="border: 0px solid grey; background: url(' . $url . '); background-size: cover; height: 144px;">';
                /*
                for ($y = 0; $y < $region_size_y; $y++) {
                    $html .= '<div class="row no-gutters">';
                    for ($x = 0; $x < $region_size_x; $x++) {
                        $html .= '<div class="col-1" style="background-color: ' . $map[$row][$col]->tiles[$y][$x]->color . '; height: 12px;">';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
                */
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    /**
     * @param int $world_size_y
     * @param int $world_size_x
     * @return array
     */
    public static function regions(int $world_size_y = 12, int $world_size_x = 12)
    {
        $region_area = array();
        $range_m = range(4, 7);
        $range_r = range(2, 9);
        $range_b = range(1, 10);
        $mainland = array_fill(4, 4, $range_m);
        $rural = array_fill(2, 8, $range_r);
        $borderland = array_fill(1, 10, $range_b);
        for ($y = 0; $y < $world_size_y; $y++) {
            for ($x = 0; $x < $world_size_x; $x++) {
                if (isset($region_area[$y][$x])) {
                    continue;
                }
                if (isset($mainland[$y]) && (in_array($x, $mainland[$y]))) {
                    $region_area[$y][$x] = 'mainland';
                } elseif (isset($rural[$y]) && (in_array($x, $rural[$y]))) {
                    $region_area[$y][$x] = 'rural';
                } elseif (isset($borderland[$y]) && (in_array($x, $borderland[$y]))) {
                    $region_area[$y][$x] = 'borderland';
                } else {
                    $region_area[$y][$x] = 'frontier';
                }
            }
        }
        return $region_area;
    }

}
