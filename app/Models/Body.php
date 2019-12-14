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

/**
 * Class Body
 * @package App\Models
 *
 * @property int $id
 * @property int $character_id
 *
 * @property string $sex
 * @property float $age
 *
 * @property int $height
 * @property int $weight
 *
 * @property int $force
 * @property int $appeal
 * @property int $condition
 * @property int $energy
 *
 * @property Size $size
 * @property Position $position
 * @property BodyPart[] $parts
 * @property Character $owner
 *
 * @property bool $dead
 */
class Body extends Model {

	/**
	 * Body constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    /**
     * @return HasOne
     */
    public function size() {

        return $this->hasOne('App\Models\Size');

    }

    /**
     * @return HasOne
     */
    public function position() {

        return $this->hasOne('App\Models\Position');

    }

    /**
     * @return HasMany
     */
    public function parts() {

        return $this->hasMany('App\Models\BodyPart');

    }

    /**
     * @return BelongsTo
     */
	public function owner() {

		return $this->belongsTo('App\Models\Character');

	}

}
