<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class Squad extends Model
{

    /**
     * @return BelongsToMany
     */
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character', 'squads_characters', 'squad_id', 'character_id');
    }

    /**
     * @return MorphOne
     */
    public function position()
    {
        return $this->morphOne('App\Models\Position', 'entity');
    }

}
