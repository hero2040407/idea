<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/6 0006
 * Time: 下午 4:25
 */
namespace app\lib\seal;

use app\api\service\Test;
use app\api\service\Two;
use app\api\service\User;
use app\lib\validate\CustomValidate;

class Factory
{
    public static function redis()
    {
        $redis = new \Redis();
        $redis->pconnect('127.0.0.1', 6379, 0);
        $redis->auth('ChenyueAbc.123');
//        $redis->select(11);
        return $redis;
    }

    /**
     * Notes:验证工厂
     * Date: 2018/9/11 0011
     * Time: 下午 3:23
     * @param $string
     * @throws
     */
    public static function validate($string)
    {
        (new CustomValidate())->requires($string)->goCheck();
    }
}