<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Character
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 *
 * @property string $name
 * @property string $nickname
 * @property string $last_name
 *
 * @property Body $body
 * @property Mind $mind
 * @property Position position
 *
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class Character extends Model
{

    use SoftDeletes;

    protected $with = ['position'];
    protected $visible = ['id', 'name', 'position'];

    /**
     * Character constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return HasOne
     */
    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory');
    }

    /**
     * @return HasOne
     */
    public function quality()
    {
        return $this->hasOne('App\Models\Character\Quality');
    }

    /**
     * @return HasOne
     */
    public function condition()
    {
        return $this->hasOne('App\Models\Character\Condition');
    }

    /**
     * @return HasMany
     */
    public function features()
    {
        return $this->hasMany('App\Models\Character\Feature');
    }

    /**
     * @return HasMany
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }

    /**
     * @return BelongsTo
     */
    public function squad()
    {
        return $this->belongsTo('App\Models\Squad');
    }

    /**
     * @return HasMany
     */
    public function relations()
    {
        return $this->hasMany('App\Models\Relation');
    }

    /**
     * @return MorphOne
     */
    public function position()
    {
        return $this->morphOne('App\Models\Position', 'entity');
    }

}
