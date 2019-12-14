<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	/**
	 * Inventory constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    public function items() {

        return $this->hasMany('App\Models\Item');

    }

	public function owner() {

		return $this->belongsTo('App\Models\Character');

	}

}
