<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $type_id
 * @property string $name
 * @property string $description
 *
 * @method static find(int $id)
 * @method static where(string $string, $id)
 * @method static delete(int $id)
 */
class Item extends Model
{

    /**
     * Item constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return HasOne
     */
    public function type()
    {
        return $this->hasOne('App\Models\ItemType', 'id', 'type_id');
    }

    /**
     * @return HasOne
     */
    public function params()
    {
        return $this->hasOne('App\Models\ItemParams', 'item_id',);
    }

}
