<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 03.10.2020
 * Time: 12:23
 */

namespace App\Helpers;


use App\Models\Name;

class GameHelper
{

    /**
     * Roll the dice
     *
     * @param int $sides
     * @return int
     */
    public static function roll(int $sides = 10)
    {
        return mt_rand(1, $sides);
    }

    /**
     * Flip a coin
     *
     * @return bool
     */
    public static function flip()
    {
        return (bool)mt_rand(0, 1);
    }

    /**
     * Draw lots
     *
     * @param int $chance
     * @return bool
     */
    public static function lots(int $chance = 50)
    {
        return (rand(1, 100) <= $chance) ? true : false;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public static function name(array $params = array())
    {
        return Name::random($params);
    }

    public static function scenario()
    {
        // dummy
        $settings = null;
        $objectives = null;
        $antagonists = null;
        $complications = null;
    }

    /**
     * @param array $suits
     * @param array $faces
     * @return array
     */
    public static function deck(array $suits = array(), array $faces = array())
    {
        $deck = array();
        foreach ($suits as $suit) {
            foreach ($faces as $face) {
                $deck[] = array("face" => $face, "suit" => $suit);
            }
        }
        return $deck;
    }

    /**
     * @param array $deck
     * @return mixed
     */
    public static function card(array $deck = array())
    {
        shuffle($deck);
        return array_shift($deck); // TODO return deck
    }

    /**
     * @param array $draw
     * @param array $deck
     * @return false|float
     */
    public static function calculate_odds(array $draw = array(), array $deck = array())
    {
        $remaining = count($deck);
        $odds = 0;
        foreach ($deck as $card) {
            if (($draw['face'] == $card['face'] && $draw['suit'] ==
                    $card['suit']) ||
                ($draw['face'] == '' && $draw['suit'] == $card['suit']) ||
                ($draw['face'] == $card['face'] && $draw['suit'] == '')) {
                $odds++;
            }
        }
        return ceil($remaining / $odds);
    }

    public static function weapons()
    {

        $weapons = array(
            'littlestick' => array(
                'name' => 'Little Stick',
                'roll' => '1d6',
                'bonus' => '0',
            ),
            'bigstick' => array(
                'name' => 'Little Stick',
                'roll' => '1d6',
                'bonus' => '4',
            ),
            'chainsaw' => array(
                'name' => 'Little Stick',
                'roll' => '2d8',
                'bonus' => '0',
            ),
        );

        foreach ($weapons as $weapon) {
            list($count, $sides) = explode('d', $weapon['roll']);
            $result = 0;
            for ($i = 0; $i < $count; $i++) {
                $result = $result + roll($sides);
            }
            echo "<tr><td>" . $weapon['name'] . "</td><td>"
                . $weapon['roll'];
            if ($weapon['bonus'] > 0) {
                echo "+" . $weapon['bonus'];
                $result = $result + $weapon['bonus'];
            }
            echo "</td><td>" . $result . "</td></tr>";
        }

    }

    public static function npc()
    {

        $rules = array(
            'health' => '36',
            'gore' => 'health/6',
            'clutch' => '1d6',
            'brawn' => '1d6',
            'sense' => '1d6',
            'flail' => '1d6',
            'chuck' => '1d6',
            'lurch' => '1d6',
        );

        $character = array();
        foreach ($rules as $stat => $rule) {
            if (preg_match("/^[0-9]+$/", $rule)) {
                // This is only a number, and is therefore a static value
                $character[$stat] = $rule;
            } else {
                if (preg_match("/^([0-9]+)d([0-9]+)/", $rule, $matches)) {
                    // This is a die roll
                    $val = 0;
                    for ($n = 0; $n < $matches[1]; $n++) {
                        $val = $val + roll($matches[2]);
                    }
                    $character[$stat] = $val;
                } else {
                    if (preg_match("/^([a-z]+)\/([0-9]+)$/", $rule, $matches)) {
                        // This is a derived value of some kind.
                        $character[$stat] = $character[$matches[1]] / $matches[2];
                    }
                }
            }
            echo $stat . ' : ' . $character[$stat] . "<br />\n";
        }

    }

    public static function map()
    {

        $map = array();
        $terrain = array('plains', 'forest', 'swamp', 'hills', 'mountain', 'water');
        for ($row = 0; $row < 20; $row++) {
            $map[] = array();
            for ($column = 0; $column < 20; $column++) {
                $pool = $terrain;
                if (isset($map[$row - 1])) {
                    if (isset($map[$row - 1][$column - 1])) {
                        $pool[] = $map[$row - 1][$column - 1];
                        $pool[] = $map[$row - 1][$column - 1];
                    }
                    $pool[] = $map[$row - 1][$column];
                    $pool[] = $map[$row - 1][$column];
                    if (isset($map[$row - 1][$column + 1])) {
                        $pool[] = $map[$row - 1][$column + 1];
                        $pool[] = $map[$row - 1][$column + 1];
                    }
                }
                if (isset($map[$row][$column - 1])) {
                    $pool[] = $map[$row][$column - 1];
                    $pool[] = $map[$row][$column - 1];
                }
                shuffle($pool);
                $map[$row][$column] = $pool[0];
            }
        }

    }

}
