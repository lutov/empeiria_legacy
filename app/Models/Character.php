<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

class Character {

	public $name = '';

	public $sex = '';

	public $age = 0;

	private $position;

	private $abilities;

	private $inventory;

	private $health;

	private $actionPoints = 0;

	private $action;

	/**
	 * Character constructor.
	 */
	public function __construct() {



	}

	/**
	 * @return mixed
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @param Position $position
	 */
	public function setPosition(Position $position) {
		$this->position = $position;
	}

}