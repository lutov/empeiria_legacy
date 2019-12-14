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

/**
 * Class Mind
 * @package App\Models
 *
 * @property int $id
 * @property int $character_id
 *
 * @property int $smart
 * @property int $practice
 * @property int $intelligence
 * @property int $nature
 *
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

}
