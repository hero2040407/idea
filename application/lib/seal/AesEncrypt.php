<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8 0008
 * Time: 上午 11:07
 */
namespace app\lib\seal;

use phpseclib\Crypt\DES;

class AesEncrypt{
    private $key;

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Notes: 生成des加密密码
     * Date: 2018/8/22 0022
     * Time: 上午 11:16
     * @throws
     * @return string
     */
    public function generateSecret(){
        return (new DES())->encrypt($this->key);
    }

    public function decrypt(){

    }
}