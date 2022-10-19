<?php


namespace App\Helpers;


use App\Models\Worlds\Biome;
use Exception;

class BiomeHelper
{

    // generation parameters
    private static int $MAX_HEIGHT = 255;

    private static float $TEMPERATURE_INCREMENT = 0.3;
    private static int $MAX_TEMPERATURE_HEIGHT = 140;
    private static int $DEFAULT_TEMPERATURE = 20;
    private static float $TEMPERATURE_SCALE = 0.001;

    private static float $HUMIDITY_TEMPERATURE = 1.3;
    private static float $HUMIDITY_HIGH_TEMP = 23;
    private static float $HUMIDITY_LOW_TEMP = 2;
    private static float $HUMIDITY_HEIGHT = 0.2;
    private static float $HUMIDITY_SCALE = 0.003;
    // end  of generation parameters

    /**
     * @param int $height
     * @param float $temperature
     * @param float $humidity
     * @param $biomes
     * @return mixed
     * @throws Exception
     */
    public static function find(int $height, float $temperature, float $humidity, $biomes)
    {
        foreach ($biomes as $biome) {
            if (($biome->height_min <= $height) && ($height <= $biome->height_max)) {
                if (($biome->temperature_min <= $temperature) && ($temperature <= $biome->temperature_max)) {
                    if (($biome->humidity_min <= $humidity) && ($humidity <= $biome->humidity_max)) {
                        return $biome;
                    }
                }
            }
        }
        throw new Exception("No biome fits the following parameters: height: " . $height . ", temperature: " . $temperature . ", humidity: " . $humidity);
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $h
     * @return float|int
     */
    public static function calculateTemperature(int $x, int $y, int $h)
    {
        $perlin = new PerlinNoiseHelper();
        $tempNoise = $perlin->random2D($x * self::$TEMPERATURE_SCALE, $y * self::$TEMPERATURE_SCALE) / 2 + 1;
        $tempNoise = self::map($tempNoise, 0.0, 2.0, 0.0, 1.0);
        $tempNoise = $tempNoise * 100 - 50;
        return self::$DEFAULT_TEMPERATURE - abs($h - self::$MAX_TEMPERATURE_HEIGHT) * self::$TEMPERATURE_INCREMENT + $tempNoise;
    }

    /**
     * @param int $x
     * @param int $y
     * @param float $temp
     * @return float|int
     */
    public static function calculateHumidity(int $x, int $y, float $temp)
    {
        $perlin = new PerlinNoiseHelper();
        $humidityNoise = $perlin->random2D($x * self::$HUMIDITY_SCALE, $y * self::$HUMIDITY_SCALE) / 2 + 1;
        $humidityNoise = self::map($humidityNoise, 0.0, 2.0, 0.0, 1.0);
        $humidityNoise = $humidityNoise * 100 - 50;
        if ($temp > self::$HUMIDITY_HIGH_TEMP) {
            $temp -= $temp - self::$HUMIDITY_HIGH_TEMP;
        } else {
            if ($temp < self::$HUMIDITY_LOW_TEMP) {
                $temp += self::$HUMIDITY_LOW_TEMP - $temp;
            }
        }
        return $humidityNoise + $temp * self::$HUMIDITY_TEMPERATURE;
    }

    /**
     * @param int $width
     * @param int $height
     * @param int $scale
     * @param Biome[] $biomes
     * @return array
     */
    public static function calculateHeight(int $width, int $height, int $scale, $biomes)
    {
        $map = array();
        $temperatureMap = array();
        $humidityMap = array();
        $biomeMap = array();
        for ($x = 0; $x != $width; $x++) {
            for ($y = 0; $y != $height; $y++) {

                //float value = noise((x + xPos + fluctuation) * scale, (y + yPos + fluctuation) * scale);
                $perlin = new PerlinNoiseHelper();
                $value = $perlin->random2D($x * $scale, $y * $scale) / 2 + 1;

                $h = round(self::map($value, 0.0, 2.0, 0, self::$MAX_HEIGHT));
                $heightMap[$x][$y] = $h;

                $temp = self::calculateTemperature($x, $y, $h);
                $humidity = self::calculateHumidity($x, $y, $temp);

                $temperatureMap[$x][$y] = $temp;
                $humidityMap[$x][$y] = $humidity;

                try {
                    $biomeMap[$x][$y] = self::find($h, $temp, $humidity, $biomes);
                } catch (Exception $e) {
                    dump($e->getMessage());
                }
            }
        }
        $map = array(
            'temperature' => $temperatureMap,
            'humidity' => $humidityMap,
            'biome' => $biomeMap,
        );
        return $map;
    }

    /**
     * @param float $value
     * @param float $istart
     * @param float $istop
     * @param float $ostart
     * @param float $ostop
     * @return float|int
     */
    public static function map(float $value, float $istart, float $istop, float $ostart, float $ostop)
    {
        return $ostart + ($ostop - $ostart) * (($value - $istart) / ($istop - $istart));
    }

    /**
     * @param array $map
     * @return string
     */
    public static function renderBiomes(array $map)
    {
        $html = '';
        $html .= '<div class="container"  style="position: absolute;">';
        foreach($map['tiles']['biome'] as $rowKey => $row) {
            $html .= '<div class="row no-gutters" id="row_'.$rowKey.'" style="border: 0px solid grey; border-left: 0; border-top: 0;">';
            foreach($row as $tile) {
                $html .= '<div class="" style="background-color: '.$tile->color.'; height: 12px; width: 12px;">';
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}
