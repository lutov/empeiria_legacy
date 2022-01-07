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

/**
 * Class Faction
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 *
 * @method static find(int $id)
 * @method static where(string $string, string $operator, string $id)
 */
class Faction extends Model
{

    protected $with = [
    ];
    protected $visible = [
        'id',
        'name',
    ];
    protected $fillable = [
        'id',
        'name',
    ];

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
