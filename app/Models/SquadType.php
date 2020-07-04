<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 *
 * @method static find(int $id)
 */
class SquadType extends Model {

    /**
     * @var string
     */
    protected $table = 'squads_types';

	/**
	 * SquadType constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

}
