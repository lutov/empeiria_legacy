<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class World extends Model
{

    protected static $type = 'world';

    /**
     * @return mixed
     */
    public static function getRandomName()
    {
        $params = array(
            array(self::$type, 1)
        );
        return Name::random($params);
    }

    public function map()
    {
        return $this->hasOne('App\Models\Map');
    }

    public function history()
    {
        return $this->hasOne('App\Models\History');
    }

}
