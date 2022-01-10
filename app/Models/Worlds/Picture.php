<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Picture
 * @package App\Models\Worlds
 * @mixin Builder
 *
 * @property int $id
 * @property string $name
 */
class Picture extends Model
{

    protected $table = 'worlds_pictures';
    protected $visible = [
        'id',
        'name',
        'path',
    ];
    protected $appends = ['path'];

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return '/img/worlds/pictures/' . $this->name . '.jpg';
    }

}
