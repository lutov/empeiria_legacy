<?php


namespace App\Helpers;


use Exception;

class BiomeHelper
{
    /**
     * @param array $biomes
     * @param int $height
     * @param float $temperature
     * @param float $humidity
     * @return mixed
     * @throws Exception
     */
    public static function find(array $biomes, int $height, float $temperature, float $humidity)
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
}
