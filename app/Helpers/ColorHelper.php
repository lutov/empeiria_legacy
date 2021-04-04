<?php


namespace App\Helpers;


class ColorHelper
{

    /**
     * @param array $color_1
     * @param array $color_2
     * @param float $weight
     * @return array
     */
    public static function mix(array $color_1 = array(0, 0, 0), array $color_2 = array(0, 0, 0), float $weight = 0.5)
    {
        $f = function ($x) use ($weight) {
            return $weight * $x;
        };

        $g = function ($x) use ($weight) {
            return (1 - $weight) * $x;
        };

        $h = function ($x, $y) {
            return round($x + $y);
        };

        return array_map($h, array_map($f, $color_1), array_map($g, $color_2));
    }

    /**
     * @param array $color
     * @param float $weight
     * @return array
     */
    public static function tint(array $color, float $weight = 0.5)
    {
        return self::mix($color, array(255, 255, 255), $weight);
    }

    /**
     * @param array $color
     * @param float $weight
     * @return array
     */
    public static function tone(array $color, float $weight = 0.5)
    {
        return self::mix($color, array(128, 128, 128), $weight);
    }

    /**
     * @param array $color
     * @param float $weight
     * @return array
     */
    public static function shade(array $color, float $weight = 0.5)
    {
        return self::mix($color, array(0, 0, 0), $weight);
    }

}
