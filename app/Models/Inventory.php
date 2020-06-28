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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Inventory
 * @package App\Models
 *
 * @property int $character_id
 *
 * @method static find(int $id)
 * @method static where(string $string, $id)
 */
class Inventory extends Model {

	/**
	 * Inventory constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    /**
     * @return BelongsToMany
     */
    public function items() {

        return $this->belongsToMany('App\Models\Item', 'inventories_items', 'inventory_id', 'item_id');

    }

    /**
     * @return BelongsTo
     */
	public function owner() {

		return $this->belongsTo('App\Models\Character');

	}

}
