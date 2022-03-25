<?php
/**
 * @desc User model
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/02/18 16:55
 */

declare(strict_types=1);

namespace app\common\model;

use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use Tinywan\ExceptionHandler\Exception\BadRequestHttpException;

class UserModel extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'resty_user';

    /**
     * @desc: 方法描述
     * @param $params
     * @return array
     * @throws BadRequestHttpException
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     * @author Tinywan(ShaoBo Wan)
     */
    public static function getPaginateList($params): array
    {
        $model = self::field('id,username,email,mobile,avatar,is_enabled,website_name,website_url,create_time');
        if (array_key_exists('username', $params) && $params['username'] != '') {
            $model = $model->whereLike('username', trim($params['username']).'%');
        }
        [$page, $count] = paginate();
        $total = $model->count();
        if (0 === $total) {
            return ['total' => $total, 'rows' => []];
        }
        $model = $model->page($page, $count);
        $item = $model->order('create_time desc')->select()->toArray();
        return ['total' => $total, 'rows' => $item];
    }
}