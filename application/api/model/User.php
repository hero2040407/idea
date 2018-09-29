<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 下午 2:47
 */
namespace app\api\model;

class User extends Base
{
    public function register($result, $userInfo)
    {
        $this->setId();
        $this->openid = $result['openid'];
        $this->session_key = $result['session_key'];
        $this->avatar = $userInfo['avatarUrl'];
        $this->nickname = $userInfo['nickName'];
        return $this;
    }
}