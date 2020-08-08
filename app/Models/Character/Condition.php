<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class BodyParams
 * @package App\Models
 *
 */
class Condition extends Model
{

    protected $visible = array('id', 'character_id', 'power', 'experience', 'luck', 'impact', 'magic', 'rich');
    protected $fillable = array('id', 'character_id', 'power', 'experience', 'luck', 'impact', 'magic', 'rich');

    /**
     * @return BelongsTo
     */
    public function character()
    {
        return $this->belongsTo('App\Models\Character');
    }

}
