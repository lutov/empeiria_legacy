<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class World extends Model {

	private $x = 32;
	private $y = 32;

	private $size;

	private $structure = array();

	public function __construct() {

		parent::__construct();

		$this->size = new Size($this->x, $this->y);

		$this->create();

	}

	private function create() {

		$structure = array();

		for($y = 1; $y <= $this->size->y; $y++) {

			for($x = 1; $x <= $this->size->x; $x++) {

				$structure[$y][$x] = array();

			}

		}

		$this->structure = $structure;

	}

	/**
	 * @return Size
	 */
	public function getSize(): Size {
		return $this->size;
	}

	/**
	 * @return array
	 */
	public function getStructure(): array {
		return $this->structure;
	}

}