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
class Map extends Model
{

    public function world()
    {
        return $this->belongsTo('App\Models\World');
    }

}
