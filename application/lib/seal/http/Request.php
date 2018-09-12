<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 上午 11:26
 */
namespace app\lib\seal\http;

use think\facade\Log;

class Request
{
    /**
     * Notes:
     * Date: 2018/9/10 0010
     * Time: 上午 11:31
     * @throws
     */
    public static function https($url, $params = '', $method = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HEADER, false); //如果设为0，则不使用header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, $method);

        if ($method)
            curl_setopt($ch, CURLOPT_POSTFIELDS,$params);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $file_contents = curl_exec($ch);//获得返回值
        curl_close($ch);
        $return_data = json_decode($file_contents, true);
        Log::info($return_data);
        return $return_data;
    }

    public static function http()
    {
        
    }


}