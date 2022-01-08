<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 04.03.2018
 * Time: 10:48
 */

namespace App\Helpers;

class TextHelper
{

    protected static array $cyrillic = array(
        "й", "ц", "у", "к", "е", "н", "г", "ш", "щ", "з", "х", "ъ",
        "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "ж", "э",
        "я", "ч", "с", "м", "и", "т", "ь", "б", "ю"
    );
    protected static array $latin = array(
        "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "[", "]",
        "a", "s", "d", "f", "g", "h", "j", "k", "l", ";", "'",
        "z", "x", "c", "v", "b", "n", "m", ",", "."
    );

    /**
     * @param string $input_text
     * @param int $limit
     * @param string $end_str
     * @return string
     */
    public static function wordsLimit(string $input_text, $limit = 50, $end_str = '…')
    {
        $input_text = strip_tags($input_text);
        $words = explode(' ', $input_text);
        if ($limit < 1 || sizeof($words) <= $limit) {
            return $input_text;
        }
        $words = array_slice($words, 0, $limit);
        $out = implode(' ', $words);
        return $out . $end_str;
    }

    /**
     * @param string $string
     * @return bool|false|mixed|string|string[]|null
     */
    public static function mb_ucwords(string $string)
    {
        return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    }

    /**
     * @param string $word
     * @param bool $all2lower
     * @return string
     */
    public static function mb_ucfirst(string $word, bool $all2lower = false)
    {
        $first = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8');
        if ($all2lower) {
            $result = $first . mb_substr(mb_convert_case($word, MB_CASE_LOWER, 'UTF-8'), 1, mb_strlen($word), 'UTF-8');
        } else {
            $result = $first . mb_substr($word, 1, mb_strlen($word), 'UTF-8');
        }
        return $result;
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function cyrillicToLatin(string $string)
    {
        $search = self::$cyrillic;
        $replace = self::$latin;
        return str_replace($search, $replace, $string);
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function latinToCyrillic(string $string)
    {
        $search = self::$latin;
        $replace = self::$cyrillic;
        return str_replace($search, $replace, $string);
    }

    /**
     * @param int $n
     * @param array $titles
     * @return mixed
     */
    public static function cardinal(int $n, array $titles = array())
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
    }

    /**
     * @param $string
     * @return string
     */
    public static function translit($string)
    {
        $replace_pairs = array(
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ь' => '',
            'Ы' => 'Y',
            'Ъ' => '',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',

            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        );
        return strtr($string, $replace_pairs);
    }
}
