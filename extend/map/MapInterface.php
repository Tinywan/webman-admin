<?php
/**
 * @desc 地图接口
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/14 17:03
 */
declare(strict_types=1);


namespace extend\map;

interface MapInterface extends \Psr\Container\ContainerInterface
{
    // 通过地址获取坐标
    public function getCoordinatesFromAddress(string $address);
}