<?php


namespace App\Properties;


class Color
{
    private int $red = 0;
    private int $green = 0;
    private int $blue = 0;

    private int $min = 0;
    private int $max = 255;

    /**
     * Color constructor.
     * @param array $color
     */
    public function __construct(array $color = array(0, 0, 0))
    {
        if (count($color)) {
            $this->red = (isset($color[0])) ? (int)$color[0] : 0;
            $this->green = (isset($color[1])) ? (int)$color[1] : 0;
            $this->blue = (isset($color[2])) ? (int)$color[2] : 0;
        }
    }

    /**
     * @param int $min
     * @param int $max
     * @return $this
     */
    public function setLimits(int $min = 0, int $max = 255)
    {
        $this->min = $min;
        $this->max = $max;
        return $this;
    }

    /**
     * @return $this
     */
    public function makeRandom()
    {
        $this->red = rand($this->min, $this->max);
        $this->green = rand($this->min, $this->max);
        $this->blue = rand($this->min, $this->max);
        return $this;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return array($this->red, $this->green, $this->blue);
    }

    /**
     * @return string
     */
    public function getHex()
    {
        return sprintf("#%02x%02x%02x", $this->red, $this->green, $this->blue);
    }

    /**
     * @return string
     */
    public function getRGB()
    {
        return 'rgb(' . $this->red . ', ' . $this->green . ', ' . $this->blue . ')';
    }

}
