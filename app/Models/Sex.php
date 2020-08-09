<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Sex
 * @package App\Models
 * @mixin Builder
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class Sex extends Model
{

    public static function random()
    {
        return self::inRandomOrder()->first();
    }

}
