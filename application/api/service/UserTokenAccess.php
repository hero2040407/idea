<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/20 0020
 * Time: 下午 6:05
 */
namespace app\api\service;

use app\lib\exception\ParameterException;
use app\lib\seal\Factory;
use think\facade\Request;

class UserTokenAccess
{
    /**
     * Notes:需要token的接口调用
     * Date: 2018/9/20 0020
     * Time: 下午 6:06
     * @throws
     */
    public static function needToken()
    {
        $token = Request::header('token');
        $uid = Factory::redis()->get($token);
        if (!$uid)
            throw new ParameterException([
                'msg' => '请先登录',
                'errorCode' => 40101
            ]);
        return $uid;
    }
}