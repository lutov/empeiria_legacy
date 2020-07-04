<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

use App\Traits\AverageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class MindParams
 * @package App\Models
 *
 * @mixin Builder
 *
 * @property int $id
 * @property int $mind_id
 *
 * @property int $smart
 * @property int $practice
 * @property int $intelligence
 * @property int $nature
 *
 * @property Mind $mind
 *
 */
class MindParams extends Model
{

    use AverageTrait;

    protected $visible = array('smart', 'practice', 'intelligence', 'nature');
    protected $fillable = array('smart', 'practice', 'intelligence', 'nature');

    /**
     * MindSpin constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return BelongsTo
     */
    public function mind()
    {
        return $this->belongsTo('App\Models\Mind');
    }

}
