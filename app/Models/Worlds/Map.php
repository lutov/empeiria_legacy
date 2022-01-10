<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class Map extends Model
{

    protected $with = ['regions'];
    protected $visible = ['size_x', 'size_y'];

    /**
     * @return BelongsTo
     */
    public function world()
    {
        return $this->belongsTo('App\Models\World\World');
    }

    /**
     * @return HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Models\World\Region');
    }

}
