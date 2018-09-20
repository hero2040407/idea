<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21 0021
 * Time: 下午 1:31
 */
namespace app\lib\seal\http;

use think\exception\HttpResponseException;

/**
 * Class Response
 * @package app\lib\seal
 *  100-199 用于指定客户端应相应的某些动作。
　  200-299 用于表示请求成功。
　　300-399 用于已经移动的文件并且常被包含在定位头信息中指定新的地址信息。
　　400-499 用于指出客户端的错误。
　　500-599 用于支持服务器错误。
 */

class Response
{

    private $errorCode;
    private $data;

    /**
     * @param mixed $errorCode
     */
    public function __construct($code = '', $data = '')
    {
        $this->errorCode = $code;
        $this->data = $data;
    }

    /**
     * Notes: 返回成功
     * Date: 2018/8/21 0021
     * Time: 下午 1:33
     */
    public function right()
    {
        throw new HttpResponseException(json([
            'code' => $this->errorCode,
            'data' => $this->data
        ], 200));
    }

    /**
     * Notes: 客户端错误
     * Date: 2018/8/21 0021
     * Time: 下午 1:41
     */
    public function fail()
    {
        throw new HttpResponseException(json([
            'code' => $this->errorCode,
            'data' => $this->data
        ], 400));
    }

    /**
     * Notes: 服务器错误
     * Date: 2018/8/21 0021
     * Time: 下午 1:41
     */
    public function systemError()
    {
        throw new HttpResponseException(json([
            'code' => $this->errorCode,
            'data' => $this->data
        ], 500));
    }

    public static function success($data)
    {
        return (new static(1,$data))->right();
    }

    public static function error($data)
    {
        return (new static(0,$data))->fail();
    }

}