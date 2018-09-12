<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/1 0001
 * Time: 上午 10:37
 */
namespace app\lib\seal;

class Redis{

    private $instance;

    public function init($host, $port)
    {
        $this->instance = new \Redis();
        $this->instance->pconnect($host, $port, 0);
    }

    public function auth($password)
    {
        $this->instance->auth($password);
    }

    public function selectDb($db)
    {
        $this->instance->select($db);
    }

    /**
     * @return mixed
     */
    public function getInstance()
    {
        return $this->instance;
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