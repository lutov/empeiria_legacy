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
 * @property string $name
 * @property string $slug
 */
class Gender extends Model
{

    protected $visible = [
        'id',
        'name',
        'slug',
    ];

    public static function random()
    {
        return self::inRandomOrder()->first();
    }

}
