<?php

namespace App\Models\Squads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Banner
 * @package App\Models\Squads
 * @mixin Builder
 *
 * @property int $id
 * @property int $world_id
 * @property string $name
 * @property string $description
 */
class Banner extends Model
{

    protected $table = 'squads_banners';
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
        return '/img/squads/banners/' . $this->name . '.jpg';
    }

}
