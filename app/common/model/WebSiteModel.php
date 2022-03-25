<?php

declare(strict_types=1);
/**
 * @author Tinywan(ShaoBo Wan)
 * @date 2020/9/29 10:37
 * @desc 站点映射表
 */

namespace app\common\model;


use think\Model;

class WebSiteModel extends Model
{
    /**
     * 数据库配置
     * @var string
     */
    public $connection = 'webman';

    /**
     * 数据表名称
     * @var string
     */
    protected $table = "sys_website";


}
