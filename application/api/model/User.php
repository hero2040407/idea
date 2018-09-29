<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 下午 2:47
 */
namespace app\api\model;

use app\api\service\UserTokenAccess;

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

    /**
     * Notes:
     * Date: 2018/9/29 0029
     * Time: 下午 4:24
     * @throws
     */
    public function incFeeling($count = 1)
    {
        $model = self::get(UserTokenAccess::getUid());
        $model->setInc('feeling',$count);
        return $model->feeling;
    }

    /**
     * Notes:减少灵感
     * Date: 2018/9/29 0029
     * Time: 下午 4:44
     * @param int $count
     * @throws
     * @return bool
     */
    public function decFeeling($count = 1)
    {
        $model = self::get(UserTokenAccess::getUid());
        $res = $model->setDec('feeling',$count);
        return $res;
    }
}