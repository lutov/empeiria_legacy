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
 * Class BodyFace
 * @package App\Models
 *
 * @mixin Builder
 *
 * @property int $id
 * @property int $body_id
 *
 * @property int $force
 * @property int $appeal
 * @property int $condition
 * @property int $energy
 *
 * @property Body $body
 *
 */
class BodyFace extends Model {

    use AverageTrait;

    protected $visible = array('force', 'appeal', 'condition', 'energy');
    protected $fillable = array('force', 'appeal', 'condition', 'energy');

	/**
	 * BodyFace constructor.
	 */
	public function __construct() {

		parent::__construct();

	}

    /**
     * @return BelongsTo
     */
	public function body() {

		return $this->belongsTo('App\Models\Body');

	}

}
