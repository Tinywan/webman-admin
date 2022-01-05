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
function response_json($code = 0, string $msg = 'ok', array $data = [], int $http_code = 200, array $header = [], bool $is_object = true)
{
    if (empty($data) && $is_object) {
        $data = (object) $data;
    }
    $result = ['code' => $code, 'msg' => $msg, 'data' => $data];
    $header = array_merge(['Content-Type' => 'application/json;charset=UTF-8'], $header);

    return new \support\Response($http_code, $header, json_encode($result));
}