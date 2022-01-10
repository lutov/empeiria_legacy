<?php

namespace App\Models\Factions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Emblem
 * @package App\Models\Factions
 * @mixin Builder
 *
 * @property int $id
 * @property int $world_id
 * @property string $name
 * @property string $description
 */
class Emblem extends Model
{

    protected $table = 'factions_emblems';
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
        return '/img/factions/emblems/' . $this->name . '.jpg';
    }

}
