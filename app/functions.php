<?php
/**
 * Here is your custom functions.
 */

/**
 * @desc: json 请求响应数据
 *
 * @param int    $code      状态码 0 为成功，其他为失败
 * @param string $msg       错误消息
 * @param array $data      消息体
 * @param int $http_code http 状态码
 * @param array $header    头部
 * @param bool $is_object 是否是对象
 * @return \support\Response
 * @author Tinywan(ShaoBo Wan)
 */
function response_json($code = 0, string $msg = 'ok', array $data = [], int $http_code = 200, array $header = [], bool $is_object = true): \support\Response
{
    if (empty($data) && $is_object) {
        $data = (object) $data;
    }
    $result = ['code' => $code, 'msg' => $msg, 'data' => $data];
    $header = array_merge(['Content-Type' => 'application/json;charset=UTF-8'], $header);

    return new \support\Response($http_code, $header, json_encode($result));
}

/**
 * @desc: 是否是手机号码
 * @param string $mobile
 * @return bool
 * @author Tinywan(ShaoBo Wan)
 */
function is_mobile(string $mobile): bool
{
    return preg_match('/^1[3-9]\d{9}$/', $mobile) ? true : false;
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
function validate(array $data, $validate = '', array $message = [], bool $batch = false, bool $failException = true)
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