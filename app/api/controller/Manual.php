<?php
/**
 * @desc Manual
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/03/22 12:52
 */

declare(strict_types=1);

namespace app\api\controller;

use support\Request;
use app\common\model\ManualModel;

class Manual
{
    public function index(Request $request)
    {
        return response("Manual");
    }
}