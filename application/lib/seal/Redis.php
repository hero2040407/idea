<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/1 0001
 * Time: 上午 10:37
 */
namespace app\lib\seal;

class Redis extends \Redis
{
    public function __construct()
    {
        $this->pconnect('127.0.0.1', 6379, 0);
    }


    /**
     * Notes:
     * Date: 2018/8/1 0001
     * Time: 上午 10:41
     * @param $key
     * @param $value
     * @param $expire
     * @throws
     */
//    public static function set($key, $value, $expire){
//        return self::$instance->set($key, $value, $expire);
//    }
//
//    public static function get($key){
//        return self::$instance->get($key);
//    }
}