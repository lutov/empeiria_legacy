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
 * Class BodyParams
 * @package App\Models
 *
 */
class Feature extends Model
{

    protected $visible = array('id', 'name', 'slug', 'description');
    protected $fillable = array('id', 'name', 'slug', 'description');

}
