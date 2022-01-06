<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Quality
 * @package App\Models\Types
 */
class Qualities extends Model
{
    protected $table = 'qualities';
    public $timestamps = false;
    protected $visible = array(
        'id',
        'name',
        'slug',
        'description'
    );
    protected $fillable = array(
        'id',
        'name',
        'slug',
        'description'
    );
}
