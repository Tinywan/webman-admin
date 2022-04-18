<?php
/**
 * @desc 谷歌地图
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/14 17:00
 */
declare(strict_types=1);


namespace extend\map;

class GoogleMap implements MapInterface
{
    public function getCoordinatesFromAddress(string $address): string
    {
        return 'Google: '.$address;
    }
}