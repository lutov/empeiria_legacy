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

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class Squad extends Model
{

    /**
     * Squad constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function size()
    {
        return $this->hasOne('App\Models\Size');
    }

    public function position()
    {
        return $this->hasOne('App\Models\Position');
    }

    /**
     * @return BelongsToMany
     */
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character', 'squads_characters', 'squad_id', 'character_id');
    }

    public function queue()
    {
        return $this->hasOne('App\Models\Queue');
    }

    public function history()
    {
        return $this->hasOne('App\Models\History');
    }

}
