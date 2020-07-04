<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 05.10.2019
 * Time: 14:10
 */

namespace App\Models;

class Position
{

    private $start;
    private $end;

    /**
     * Position constructor.
     * @param  array  $start
     * @param  array  $end
     */
    public function __construct(array $start = array(), array $end = array())
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return array
     */
    public function getStart(): array
    {
        return $this->start;
    }

    /**
     * @return array
     */
    public function getEnd(): array
    {
        return $this->end;
    }

    /**
     * @return Size
     */
    public function getSize()
    {
        $x = ($this->end['x'] + 1) - $this->start['x'];
        $y = ($this->end['y'] + 1) - $this->start['y'];

        $size = new Size($x, $y);

        return $size;
    }

}