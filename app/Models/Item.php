<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model {

	/**
	 * Item constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    /**
     * @return HasOne
     */
	public function type() {

	    return $this->hasOne('App\Models\ItemType', 'id', 'type_id');

    }

    /**
     * @return HasOne
     */
	public function params() {

	    return $this->hasOne('App\Models\ItemParams', 'item_id',);

    }

}
