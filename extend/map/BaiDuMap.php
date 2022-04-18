<?php
/**
 * @desc 百度地图
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/14 17:01
 */
declare(strict_types=1);


namespace extend\map;

class BaiDuMap implements MapInterface
{
    public function getCoordinatesFromAddress(string $address): string
    {
        return 'BaiDu: '.$address;
    }
}