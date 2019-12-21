<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:07
 */

namespace App\Traits;

trait AverageTrait {

    /**
     * @param array $first
     * @param array $second
     * @return array
     */
    public static function getAverage(array $first = array(), array $second = array()) {
        $keys = array_keys($first);
        $values = array_map('self::average', $first, $second);
        return array_combine($keys, $values);
    }

    /**
     * @param int $a
     * @param int $b
     * @return false|float
     */
    private function average(int $a = 0, int $b = 0) {
        return round(($a + $b) / 2);
    }

}
