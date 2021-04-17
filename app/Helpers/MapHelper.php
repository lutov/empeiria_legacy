<?php


namespace App\Helpers;


use App\Models\Name;
use App\Models\World\Region;
use App\Models\World\Tile;

class MapHelper
{

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
        for ($row = 0; $row < $world_size_y; $row++) {
            for ($col = 0; $col < $world_size_x; $col++) {
                $region = new Region();
                $region->id = $region_id;
                $region->name = Name::random();
                $picker = new RandomHelper();
                $picker->addElement(array('green', 'green'), 100);
                $picker->addElement(array('green', 'orange'), 75);
                $picker->addElement(array('orange', 'orange'), 50);
                $picker->addElement(array('orange', 'yellow'), 40);
                $picker->addElement(array('yellow', 'blue'), 30);
                $picker->addElement(array('blue', 'blue'), 25);
                $picker->addElement(array('blue', 'red'), 20);
                $picker->addElement(array('red', 'red'), 15);
                $picker->addElement(array('purple', 'purple'), 10);
                $picker->addElement(array('red', 'purple'), 10);
                $hue = 'monochrome';
                $luminosity = 'bright';
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

}
