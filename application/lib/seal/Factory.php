<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/6 0006
 * Time: 下午 4:25
 */
namespace app\lib\seal;

class Factory
{
    public static function redis()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379, 0);
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
        (new \app\lib\validate\CustomValidate())
            ->requires($string)->goCheck();
    }
}