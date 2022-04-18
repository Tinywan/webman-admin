<?php
/**
 * @desc StoreService.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/14 17:05
 */
declare(strict_types=1);


namespace extend\map;


class StoreService
{
    private MapInterface $map;

    public function __construct(MapInterface $map)
    {
        $this->map = $map;
    }

    // 获取店铺坐标
    public function getStoreCoordinates($store) {
        return $this->map->getCoordinatesFromAddress($this->getAddress($store));
    }

    // 获取店铺地址
    private function getAddress($store) {
        $res = [
            '1' => '西大街',
            '2' => '北大街',
        ];
        return $res[$store];
    }
}