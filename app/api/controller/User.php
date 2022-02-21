<?php
/**
 * @desc User
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2022/2/21 22:28
 */

declare(strict_types=1);

namespace app\api\controller;


use app\common\model\UserModel;
use support\exception\BadRequestHttpException;
use support\Request;
use support\Response;

class User
{
    /**
     * @desc: 列表
     * @param Request $request
     * @return Response
     * @throws BadRequestHttpException
     * @author Tinywan(ShaoBo Wan)
     */
    public function getList(Request $request): Response
    {
        $params = $request->get();
        return response_json(0, 'success',UserModel::getPaginateList($params));
    }
}