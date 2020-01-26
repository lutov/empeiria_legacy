<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

class Mass {

	private float $mass = 0;

	public function __construct(int $mass = 0) {

	    $this->mass = $mass;

    }

    /**
     * @return int
     */
    public function getMass(): int {
        return $this->mass;
    }

    /**
     * @param int $mass
     */
    public function setMass(int $mass): void {
        $this->mass = $mass;
    }

}
