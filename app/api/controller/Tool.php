<?php
/**
 * @desc Tool
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/03/22 12:52
 */

declare(strict_types=1);

namespace app\api\controller;

use support\Request;
use support\Response;
use Tinywan\Captcha\Captcha;

class Tool
{
    /**
     * @desc: 获取验证码
     * @param Request $request
     * @return Response
     * @author Tinywan(ShaoBo Wan)
     */
    public function captcha(Request $request):Response
    {
        return response_json(0,'captcha',['captcha'=>Captcha::base64()]);
    }
}