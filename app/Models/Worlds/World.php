<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class World extends Model
{

    protected static $type = 'world';

    protected $with = ['map'];
    protected $visible = ['id', 'name', 'map'];

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

    /**
     * @return HasOne
     */
    public function map()
    {
        return $this->hasOne('App\Models\World\Map');
    }

    /**
     * @return HasOne
     */
    public function history()
    {
        return $this->hasOne('App\Models\History');
    }

}
