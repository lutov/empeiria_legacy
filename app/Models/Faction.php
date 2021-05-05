<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 21.06.2020
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faction extends Model
{

    /**
     * Faction constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return BelongsToMany
     */
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character', 'factions_characters', 'faction_id', 'character_id');
    }

}
