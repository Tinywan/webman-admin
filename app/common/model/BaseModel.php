<?php
/**
 * @desc 基础model
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/02/18 16:55
 */

declare(strict_types=1);

namespace app\common\model;

use think\Model;

class BaseModel extends Model
{
    /**
     * 设置软删除字段的默认值
     * @var int
     */
    protected $defaultSoftDelete = 0;

    /**
     * 定义软删除标记字段
     * @var string
     */
    protected string $deleteTime = 'delete_time';

    /**
     * 架构函数
     * @access public
     * @param array $data 数据
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->connection = request()->website;
    }
}