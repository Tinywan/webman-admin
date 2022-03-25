<?php
/**
 * @desc 描述
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/19 16:55
 */

declare(strict_types=1);

namespace app\controller;


use app\common\model\UserModel;
use support\Request;
use support\Response;
use Tinywan\Captcha\Captcha;

class System
{
    /**
     * @desc: 菜单列表
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function menu(Request $request): Response
    {
        $menu = [
            [
                'name'=>'home',
                'path'=>'/home',
                'meta'=>[
                    'title' => '首页',
                    'icon' => 'el-icon-eleme-filled',
                    'type' => 'menu'
                ],
                'children' => [
                    [
                        'name'=>'dashboard',
                        'path'=>'/dashboard',
                        'meta'=>[
                            'title' => '控制台',
                            'icon' => 'el-icon-menu',
                            'affix' => true
                        ],
                        "component"=>"home"
                    ],
                    [
                        'name'=>'userCenter',
                        'path'=>'/userCenter',
                        'meta'=>[
                            'title' => '个人信息',
                            'icon' => 'el-icon-user',
                            'affix' => true
                        ],
                        "component"=>"userCenter"
                    ]
                ]
            ],
            [
                'name'=>'basic',
                'path'=>'/basic',
                'meta'=>[
                    'title' => '基础管理',
                    'icon' => 'el-icon-setting',
                    'type' => 'menu'
                ],
                'children' => [
                    [
                        'name'=>'article',
                        'path'=>'/basic/article',
                        'meta'=>[
                            'title' => '文章管理',
                            'icon' => 'el-icon-user-filled',
                            'affix' => true
                        ],
                        "component"=>"basic/article"
                    ]
                ]
            ]
        ];
        $data = [
            'permissions' => [
                "list.add",
                "list.edit",
                "list.delete",
                "user.add",
                "user.edit",
                "user.delete"
            ],
            'menu' => $menu
        ];
        return json(['code' => 0, 'msg' => 'success','data'=>$data]);
    }

    /**
     * @desc: 方法描述
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function tableList(Request $request): Response
    {
        $data = UserModel::getPaginateList($request->get());
        return response_json(200,'success',$data);
    }

    /**
     * @desc: 方法描述
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function tableInfo(Request $request): Response
    {
        $id = $request->get('id');
        $info = UserModel::where('id',$id)->findOrEmpty();
        if ($info->isEmpty()) {
            return response_json(200,'success');
        }
        return response_json(200,'success',$info->toArray());
    }

    /**
     * @desc: 获取验证码
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function captcha(Request $request):Response
    {
        return response_json(200,'captcha',['captcha'=>Captcha::base64()]);
    }

    /**
     * @desc: 获取验证码
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function checkCaptcha(Request $request):Response
    {
        return response_json(200,'captcha',['captcha'=>Captcha::base64()]);
    }
}