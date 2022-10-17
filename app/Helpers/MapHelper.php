<?php


namespace App\Helpers;


use App\Models\Names\Name;
use App\Models\Worlds\Region;
use App\Models\Worlds\Tile;

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
     * @param int $worldSizeY
     * @param int $worldSizeX
     * @param int $regionSizeY
     * @param int $regionSizeX
     * @return array
     */
    public static function generate(
        int $worldSizeY = 12,
        int $worldSizeX = 12,
        int $regionSizeY = 12,
        int $regionSizeX = 12
    ) {
        $map = array();
        $regionId = 1;
        $regionArea = self::regions();
        for ($row = 0; $row < $worldSizeY; $row++) {
            for ($col = 0; $col < $worldSizeX; $col++) {
                $area = self::$areas[$regionArea[$row][$col]];
                $map['regions'][$row][$col] = self::generateRegion(
                    $regionId,
                    $area,
                    $regionSizeY,
                    $regionSizeX,
                    $row,
                    $col
                );
                $regionId++;
            }
        }
        return $map;
    }

    /**
     * @param int $regionId
     * @param array $area
     * @param int $regionSizeY
     * @param int $regionSizeX
     * @param int $row
     * @param int $col
     * @return Region
     */
    public static function generateRegion(
        int $regionId = 0,
        array $area = array(),
        int $regionSizeY = 12,
        int $regionSizeX = 12,
        int $row = 0,
        int $col = 0
    ) {
        $hue = 'monochrome';
        $luminosity = 'light';
        $region = new Region();
        $region->id = $regionId;
        $region->name = Name::random();
        $picker = new RandomHelper();
        foreach ($area as $element) {
            try {
                $picker->addElement($element['colors'], $element['weight']);
            } catch (\InvalidArgumentException $e) {
                dump($e->getMessage());
            }
        }
        try {
            $hue = $picker->getRandomElement();
        } catch (\RuntimeException $e) {
            dump($e->getMessage());
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        $regionColor = ColorHelper::one(array('luminosity' => $luminosity, 'hue' => $hue));
        $region->color = $regionColor;
        $tiles = array();
        $tilesColors = ColorHelper::many($regionSizeX, array('luminosity' => $luminosity, 'hue' => $hue));
        for ($y = 0; $y < $regionSizeY; $y++) {
            if(GameHelper::odds(75)) {
                // с шансом в 25% формируем следующий ряд из тех же цветов, чтобы создать кластеры
                $tilesColors = ColorHelper::many($regionSizeX, array('luminosity' => $luminosity, 'hue' => $hue));
            }
            $tileColor = $tilesColors[0];
            for ($x = 0; $x < $regionSizeX; $x++) {
                if($tileColor !== $tilesColors[$x]) {
                    if (GameHelper::odds(66)) {
                        $tileColor = $tilesColors[$x];
                    } else {
                        // с шансом в 33% смешиваем предыдущий цвет, чтобы создать кластеры и разбить монотонность карты
                        $rgbTileColor = ColorHelper::hex2rgb($tileColor);
                        $rgbTileColorX = ColorHelper::hex2rgb($tilesColors[$x]);
                        $mixTileColor = ColorHelper::mix($rgbTileColor, $rgbTileColorX, 0.66);
                        $tileColor = ColorHelper::rgb2hex($mixTileColor);
                    }
                }
                $tiles[$y][$x] = self::generateTile(
                    $regionId,
                    $regionSizeY,
                    $regionSizeX,
                    $row,
                    $col,
                    $tileColor
                );
            }
        }
        $region->tiles = $tiles;
        return $region;
    }

    /**
     * @param int $regionId
     * @param int $y
     * @param int $x
     * @param int $row
     * @param int $col
     * @param string $color
     * @return Tile
     */
    public static function generateTile(
        int $regionId = 0,
        int $y = 12,
        int $x = 12,
        int $row = 0,
        int $col = 0,
        string $color = ''
    ) {
        $tile = new Tile();
        $tile->region_id = $regionId;
        $tile->local_y = $y;
        $tile->local_x = $x;
        $tile->global_y = $row + $y;
        $tile->global_x = $col + $x;
        $tile->color = $color;
        return $tile;
    }

    /**
     * @param array $map
     * @param int $world_id
     */
    public static function draw(array $map, int $world_id)
    {
        $worldSizeY = count($map['regions']);
        $worldSizeX = count($map['regions'][0]);
        $regionSizeY = count($map['regions'][0][0]->tiles);
        $regionSizeX = count($map['regions'][0][0]->tiles[0]);
        $tileSizeY = 12;
        $tileSizeX = 12;
        $regionFullSizeX = ($regionSizeX * $tileSizeX);
        $regionFullSizeY = ($regionSizeY * $tileSizeY);
        $worldFullSizeX = ($worldSizeX * $regionFullSizeX);
        $worldFullSizeY = ($worldSizeY * $regionFullSizeY);
        $world = imagecreatetruecolor($worldFullSizeX, $worldFullSizeY);
        $dst_y = 0;
        for ($row = 0; $row < $worldSizeY; $row++) {
            $dst_x = 0;
            for ($col = 0; $col < $worldSizeX; $col++) {
                $mapRegion = $map[$row][$col];
                $region = self::drawRegion(
                    $regionSizeY,
                    $regionSizeX,
                    $regionFullSizeY,
                    $regionFullSizeX,
                    $tileSizeY,
                    $tileSizeX,
                    $mapRegion
                );
                imagecopy($world, $region, $dst_x, $dst_y, 0, 0, $regionFullSizeX, $regionFullSizeY);
                $path = 'img/worlds/' . $world_id . '/map/regions/' . $map[$row][$col]->id . '.png';
                imagepng($region, public_path($path));
                imagedestroy($region);
                $dst_x += $regionFullSizeX;
            }
            $dst_y += $regionFullSizeY;
        }
        //imagefilter($world, IMG_FILTER_GAUSSIAN_BLUR);
        //imagefilter($world, IMG_FILTER_PIXELATE, 5);
        $path = 'img/worlds/' . $world_id . '/map/map.jpg';
        imagejpeg($world, public_path($path));
        imagedestroy($world);
    }

    /**
     * @param int $regionSizeY
     * @param int $regionSizeX
     * @param int $regionFullSizeY
     * @param int $regionFullSizeX
     * @param int $tileSizeY
     * @param int $tileSizeX
     * @param Region|null $mapRegion
     * @return false|resource
     */
    public static function drawRegion(
        int $regionSizeY = 0,
        int $regionSizeX = 0,
        int $regionFullSizeY = 0,
        int $regionFullSizeX = 0,
        int $tileSizeY = 0,
        int $tileSizeX = 0,
        Region $mapRegion = null
    )
    {
        $region = imagecreatetruecolor($regionFullSizeX, $regionFullSizeY);
        $y1 = 0;
        for ($y = 0; $y < $regionSizeY; $y++) {
            $x1 = 0;
            $y2 = $y1 + ($tileSizeY - 1);
            for ($x = 0; $x < $regionSizeX; $x++) {
                $x2 = $x1 + ($tileSizeX - 1);
                $rgb = ColorHelper::hex2rgb($mapRegion->tiles[$y][$x]->color);
                $color = imagecolorallocate($region, $rgb[0], $rgb[1], $rgb[2]);
                //dd($region, $x1, $y1, $x2, $y2, $color);
                imagefilledrectangle($region, $x1, $y1, $x2, $y2, $color);
                $x1 = $x2 + 1;
            }
            $y1 = $y2 + 1;
        }
        return $region;
    }

    /**
     * @param array $map
     * @param int $world_id
     * @return string
     */
    public static function render(array $map, int $world_id)
    {
        $html = '';
        $worldSizeY = count($map['regions']);
        $worldSizeX = count($map['regions'][0]);
        $regionSizeY = count($map['regions'][0][0]->tiles);
        $regionSizeX = count($map['regions'][0][0]->tiles[0]);
        $html .= '<div class="container">';
        for ($row = 0; $row < $worldSizeY; $row++) {
            $html .= '<div class="row no-gutters" id="row_'.$row.'" style="border: 0px solid grey; border-left: 0; border-top: 0;">';
            for ($col = 0; $col < $worldSizeX; $col++) {
                $url = '\'/public/img/worlds/' . $world_id . '/map/regions/' . $map['regions'][$row][$col]->id . '.png\'';
                $html .= '<div class="col-1" style="border: 0px solid grey; border-right: 0; border-bottom: 0; background: url(' . $url . '); background-size: cover; height: 144px;" id="row_'.$row.'_col_'.$col.'">';
                for ($y = 0; $y < $regionSizeY; $y++) {
                    $html .= '<div class="row no-gutters">';
                    for ($x = 0; $x < $regionSizeX; $x++) {
                        $html .= '<div class="col-1" style="background-color: ' . $map['regions'][$row][$col]->tiles[$y][$x]->color . '; height: 12px; width: 12px;">';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    /**
     * @param int $worldSizeY
     * @param int $worldSizeX
     * @return array
     */
    public static function regions(int $worldSizeY = 12, int $worldSizeX = 12)
    {
        $region_area = array();
        $range_m = range(4, 7);
        $range_r = range(2, 9);
        $range_b = range(1, 10);
        $mainland = array_fill(4, 4, $range_m);
        $rural = array_fill(2, 8, $range_r);
        $borderland = array_fill(1, 10, $range_b);
        for ($y = 0; $y < $worldSizeY; $y++) {
            for ($x = 0; $x < $worldSizeX; $x++) {
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
