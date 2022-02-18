<?php
/**
 * @desc BaseController.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/1/5 13:25
 */

declare(strict_types=1);

namespace app\common\controller;

use Tinywan\Validate\Exception\ValidateException;
use Tinywan\Validate\Facade\Validate;
use function strpos;
use function is_array;
use function explode;

class BaseController
{
    /**
     * 是否批量验证
     *
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 验证数据.
     *
     * @param array        $data     数据
     * @param string|array $validate 验证器名或者验证规则数组
     * @param array        $message  提示信息
     * @param bool         $batch    是否批量验证
     *
     * @return array|string|true
     *
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                list($validate, $scene) = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $validate;
            $v = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }
}