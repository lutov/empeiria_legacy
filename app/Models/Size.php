<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

class Size {

	public $x = 0;
	public $y = 0;

	/**
	 * Size constructor.
	 * @param int $x
	 * @param int $y
	 */
	public function __construct(int $x = 0, int $y = 0) {

		$this->x = $x;
		$this->y = $y;

	}

}