<?php


namespace App\Helpers;


class LandscapeHelper
{
    /**
     * @param array $map
     * @return array
     */
    public static function addHeight(array $map)
    {
        foreach($map['tiles'] as $y => $tileRow) {
            foreach($tileRow as $x => $tileCol) {
                if('land' == $tileCol['terrain']) {
                    $color = ColorHelper::hex2rgb($tileCol['color']);
                    $chance = 50;
                    if (GameHelper::odds($chance)) {
                        $height = 1.0 - (rand(0, 3) / 10);
                        $landscapeColor = ColorHelper::tone($color, $height);
                    } else {
                        $height = 1.0 - (rand(0, 3) / 10);
                        $landscapeColor = ColorHelper::tint($color, $height);
                    }
                    $map['tiles'][$x][$y]['height'] = $height;
                    $map['tiles'][$x][$y]['color'] = ColorHelper::rgb2hex($landscapeColor);
                } else {
                    $map['tiles'][$x][$y]['height'] = 0.0;
                }
            }
        }
        return $map;
    }
}
