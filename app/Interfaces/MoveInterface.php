<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 07.07.2020
 * Time: 17:35
 */

namespace App\Interfaces;

use App\Models\Position;

interface MoveInterface
{
    public function move(Position $destination);
}
