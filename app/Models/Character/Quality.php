<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Quality
 * @package App\Models\Character
 */
class Quality extends Model
{

    protected $table = 'characters_qualities';

    protected $visible = array('id', 'character_id', 'quality_id');
    protected $fillable = array('id', 'character_id', 'quality_id');

}
