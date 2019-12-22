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
 * @property MindParams $params
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
    public function params() {

        return $this->hasOne('App\Models\MindParams');

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function setParams(array $params = array()) {

        $mindParams = new MindParams();
        $mindParams->fill($params);
        $this->params()->save($mindParams);

        return $this->spin();

    }

}
