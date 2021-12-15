<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Gender
 * @package App\Models
 * @mixin Builder
 *
 * @property int $id
 * @property int $gender_id
 * @property string $name
 */
class Avatar extends Model
{

    public static function random()
    {
        return self::inRandomOrder()->first();
    }

}
