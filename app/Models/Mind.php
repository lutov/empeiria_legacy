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
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Mind
 * @package App\Models
 *
 * @property int $id
 * @property int $character_id
 *
 * @property MindSpin $spin
 * @property Character $owner
 */
class Mind extends Model {

	/**
	 * Mind constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    /**
     * @return BelongsTo
     */
	public function owner() {

		return $this->belongsTo('App\Models\Character');

	}

    /**
     * @return HasOne
     */
    public function spin() {

        return $this->hasOne('App\Models\MindSpin');

    }

    /**
     * @param array $spin
     * @return mixed
     */
    public function setSpin(array $spin = array()) {

        $mindSpin = new MindSpin();
        $mindSpin->fill($spin);
        $this->spin()->save($mindSpin);

        return $this->spin();

    }

}
