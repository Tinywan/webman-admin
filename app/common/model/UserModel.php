<?php
/**
 * @desc User model
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/02/18 16:55
 */

declare(strict_types=1);

namespace app\common\model;

class UserModel extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'resty_user';

    /**
     * @desc: 分页查询
     * @param $params
     * @throws \support\exception\BadRequestHttpException
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
            return ['total' => $total, 'list' => []];
        }
        $model = $model->page($page, $count);
        $item = $model->order('create_time desc')->select();
        return ['total' => $total, 'list' => $item];
    }
}