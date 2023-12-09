<?php
/**
 * Here is your custom functions.
 */

use support\Response;
use Tinywan\ExceptionHandler\Exception\BadRequestHttpException;

/**
 * @desc: json 请求响应数据
 *
 * @param int    $code      状态码 0 为成功，其他为失败
 * @param string $msg       错误消息
 * @param array $data      消息体
 * @param int $http_code http 状态码
 * @param array $header    头部
 * @param bool $is_object 是否是对象
 * @return Response
 * @author Tinywan(ShaoBo Wan)
 */
function response_json($code = 0, string $msg = 'ok', array $data = [], int $http_code = 200, array $header = [], bool $is_object = true): Response
{
    if (empty($data) && $is_object) {
        $data = (object) $data;
    }
    $result = ['code' => $code, 'msg' => $msg, 'data' => $data];
    $header = array_merge(['Content-Type' => 'application/json;charset=UTF-8'], $header);

    return new Response($http_code, $header, json_encode($result));
}

/**
 * @desc: 是否是手机号码
 * @param string $mobile
 * @return bool
 * @author Tinywan(ShaoBo Wan)
 */
function is_mobile(string $mobile): bool
{
    return (bool) preg_match('/^1[3-9]\d{9}$/', $mobile);
}

/**
 * @desc 验证器助手函数
 * @param array $data 数据
 * @param string|array $validate 验证器类名或者验证规则数组
 * @param array $message 错误提示信息
 * @param bool $batch 是否批量验证
 * @param bool $failException 是否抛出异常
 * @return bool
 * @author Tinywan(ShaoBo Wan)
 */
function validate(array $data, $validate = '', array $message = [], bool $batch = false, bool $failException = true): bool
{
    if (is_array($validate)) {
        $v = new \Tinywan\Validate\Validate();
        $v->rule($validate);
    } else {
        if (strpos($validate, '.')) {
            [$validate, $scene] = explode('.', $validate);
        }
        $class = false !== strpos($validate, '\\') ? $validate : $validate;
        $v = new $class();
        if (!empty($scene)) {
            $v->scene($scene);
        }
    }
    return $v->message($message)->batch($batch)->failException($failException)->check($data);
}

/**
 * @desc: 返回分页查询时需要的参数
 * @return array
 * @throws BadRequestHttpException
 * @author Tinywan(ShaoBo Wan)
 */
function paginate(): array
{
    $page = intval(request()->get('page', 1));
    $per_page = intval(request()->get('per_page', 10));
    if ($page < 0 || $per_page < 0) {
        throw new BadRequestHttpException();
    }
    $per_page = $per_page > 10 ? 100 : $per_page;

    return [$page, $per_page];
}

/**
 * @desc: 消息广播json数据
 * @param int $code
 * @param string $msg
 * @param array $data
 * @return false|string
 * @author Tinywan(ShaoBo Wan)
 */
function broadcast_json(int $code = 0, string $msg = 'success', array $data = [])
{
    return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data], JSON_UNESCAPED_UNICODE);
}

/**
 * @desc: 获取客户端真实ip
 * @param string $ip
 * @return mixed|string
 * @author Tinywan(ShaoBo Wan)
 */
function get_client_real_ip(string $ip)
{
    $isValid = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
    if ($isValid) {
        return $isValid;
    }
    return explode(',', $ip)[0] ?? '127.0.0.1';
}

/**
 * @desc: 获取客户端浏览器以及版本号
 * @param string $agent
 * @return string
 * @author Tinywan(ShaoBo Wan)
 */
function get_client_browser(string $agent = ''): string
{
    $browser = '';
    $browser_ver = '';
    if (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs)) {
        $browser = 'OmniWeb';
        $browser_ver = $regs[2];
    }
    if (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $browser = 'Netscape';
        $browser_ver = $regs[2];
    }
    if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
        $browser = 'Safari';
        $browser_ver = $regs[1];
    }
    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $browser = 'Internet Explorer';
        $browser_ver = $regs[1];
    }
    if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $browser = 'Opera';
        $browser_ver = $regs[1];
    }
    if (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs)) {
        $browser = '(Internet Explorer ' . $browser_ver . ') NetCaptor';
        $browser_ver = $regs[1];
    }
    if (preg_match('/Maxthon/i', $agent, $regs)) {
        $browser = '(Internet Explorer ' . $browser_ver . ') Maxthon';
        $browser_ver = '';
    }
    if (preg_match('/360SE/i', $agent, $regs)) {
        $browser = '(Internet Explorer ' . $browser_ver . ') 360SE';
        $browser_ver = '';
    }
    if (preg_match('/SE 2.x/i', $agent, $regs)) {
        $browser = '(Internet Explorer ' . $browser_ver . ') 搜狗';
        $browser_ver = '';
    }
    if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
        $browser = 'FireFox';
        $browser_ver = $regs[1];
    }
    if (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs)) {
        $browser = 'Lynx';
        $browser_ver = $regs[1];
    }
    if (preg_match('/Chrome\/([^\s]+)/i', $agent, $regs)) {
        $browser = 'Chrome';
        $browser_ver = $regs[1];
    }
    if (preg_match('/MicroMessenger\/([^\s]+)/i', $agent, $regs)) {
        $browser = '微信浏览器';
        $browser_ver = $regs[1];
    }
    if ($browser != '') {
        $res = ['browser' => $browser, 'browser_ver' => $browser_ver];
    } else {
        $res = ['browser' => '未知', 'browser_ver' => ''];
    }
    return implode('|', $res);
}
