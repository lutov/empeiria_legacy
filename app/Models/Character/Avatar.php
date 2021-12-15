<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected $visible = [
        'id',
        'name',
        'gender_id',
        'path',
    ];
    protected $appends = ['path'];

    /**
     * @param Gender $gender
     * @return Avatar|Model|object|null
     */
    public static function random(Gender $gender)
    {
        return self::select('name')
            ->where('gender_id', '=', $gender->id)
            ->inRandomOrder()
            ->value('name');
    }

    /**
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Character\Gender');
    }

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return '/img/characters/avatars/' . $this->gender->slug . '/' . $this->name . '.jpg';
    }

}
