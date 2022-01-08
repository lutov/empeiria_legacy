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
 * @method static create(array $characterQualities)
 */
class Quality extends Model
{

    protected $table = 'characters_qualities';
    public $timestamps = false;
    protected $visible = array(
        'appeal',
        'vitality',
        'intellect',
        'sociality',
        'mobility',
        'willpower',
    );
    protected $fillable = array(
        'character_id',
        'appeal',
        'vitality',
        'intellect',
        'sociality',
        'mobility',
        'willpower',
    );

}
