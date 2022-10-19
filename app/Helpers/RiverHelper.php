<?php


namespace App\Helpers;


class RiverHelper
{
    /**
     * @param int $width
     * @param int $height
     * @param int $sourceX
     * @param int $sourceY
     * @param int $mouthX
     * @param int $mouthY
     * @param int $bifurcations
     * @param int $size
     * @param int $count
     * @param array $river
     * @return array
     */
    public static function generate(
        int $width,
        int $height,
        int $sourceX = 0,
        int $sourceY = 0,
        int $mouthX = 0,
        int $mouthY = 0,
        int $bifurcations = 1,
        int $size = 1,
        int $count = 5,
        array $river = array()
    )
    {
        $soilColor = 'none';
        $waterColor = '#6d77e0';
        //$waterColor = '#5f7ed3';
        $lastX = $width;
        $lastY = $height;
        if(!count($river)) {
            $river = array();
            for($y = 0; $y < $lastY; $y++) {
                $river[$y] = array_fill(0, $lastX, $soilColor);
            }
        }

        $divide = 4;
        if(!$sourceX || !$sourceY) {
            $offsetX = ceil($width / $divide);
            $limitX = $width - ceil($width / $divide);
            $sourceX = rand($offsetX, $limitX);

            $offsetY = ceil($height / $divide);
            $limitY = $height - ceil($height / $divide);
            $sourceY = rand($offsetY, $limitY);
        }

        if(!$mouthX || !$mouthY) {
            list($mouthX, $mouthY) = self::getMouth($lastX, $lastY);
        }

        $x = $sourceX;
        $y = $sourceY;
        while($y != $mouthY) {
            if($x != $mouthX) {
                if (GameHelper::odds(15) && (0 < $bifurcations)) {
                    $bifurcations = ($bifurcations - 1);
                    $river = self::generate($width, $height, $x, $y, 0, 0, $bifurcations, $size, 1, $river);
                    $river = self::generate($width, $height, $x, $y, 0, 0, $bifurcations, $size, 1, $river);
                    break;
                }
                $river = self::setColor($x, $y, $waterColor, $river);
                $x = ($x <= $mouthX) ? ($x + 1) : ($x - 1);
            }
            if (GameHelper::odds(30)) {
                $y = ($y <= $mouthY) ? ($y + 1) : ($y - 1);
                /* TODO figure out how to make turns smoother
                $xTmp = ($x <= $mouthX) ? ($x + 1) : ($x - 1);
                if(isset($river[$y][$xTmp])) {
                    $river = self::setColor($xTmp, $y, $waterColor, $river);
                }
                */
            }
        }
        $count = ($count - 1);
        while(0 < $count) {
            $bifurcations = 1;
            if (GameHelper::odds(25)) {
                $mouthX = $x;
                $mouthY = $y;
            }
            $river = self::generate($width, $height, 0, 0, $mouthX, $mouthY, $bifurcations, $size, 1, $river);
            $count = ($count - 1);
        }
        return $river;
    }

    /**
     * @param $lastX
     * @param $lastY
     * @return array
     */
    public static function getMouth($lastX, $lastY)
    {
        $mouthX = 0;
        $mouthY = 0;
        $mouthDirection = rand(1, 4);
        switch ($mouthDirection) {
            case 1:
                $mouthX = -1;
                $mouthY = -1;
                break;
            case 2:
                $mouthX = -1;
                $mouthY = $lastY;
                break;
            case 3:
                $mouthX = $lastX;
                $mouthY = -1;
                break;
            case 4:
                $mouthX = $lastX;
                $mouthY = $lastY;
                break;
        }
        return array($mouthX, $mouthY);
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $waterColor
     * @param array $river
     * @return array
     */
    public static function setColor(int $x, int $y, string $waterColor, array $river)
    {
        if($waterColor != $river[$y][$x]) {
            $river[$y][$x] = $waterColor;
        } else {
            // flooding lands if rivers cross there
            if(isset($river[$y-1])) {
                if(isset($river[$y-1][$x-1])) {$river[$y-1][$x-1] = $waterColor;}
                if(isset($river[$y-1][$x])) {$river[$y-1][$x] = $waterColor;}
                if(isset($river[$y-1][$x+1])) {$river[$y-1][$x+1] = $waterColor;}
            } elseif(isset($river[$y+1])) {
                if(isset($river[$y+1][$x-1])) {$river[$y+1][$x-1] = $waterColor;}
                if(isset($river[$y+1][$x])) {$river[$y+1][$x] = $waterColor;}
                if(isset($river[$y+1][$x+1])) {$river[$y+1][$x+1] = $waterColor;}
            }
            if(isset($river[$y][$x-1])) {$river[$y][$x-1] = $waterColor;}
            if(isset($river[$y][$x+1])) {$river[$y][$x+1] = $waterColor;}
        }
        return $river;
    }

    /**
     * @param array $map
     * @return string
     */
    public static function render2D(array $map)
    {
        $html = '';
        $html .= '<div class="container" style="position: absolute;">';
        foreach($map as $rowKey => $row) {
            $html .= '<div class="row no-gutters" id="row_'.$rowKey.'" style="border: 0px solid grey; border-left: 0; border-top: 0;">';
            foreach($row as $tile) {
                $html .= '<div class="" style="background-color: '.$tile.'; height: 12px; width: 12px;">';
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}
