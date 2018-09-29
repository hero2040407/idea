<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 上午 11:10
 */
namespace app\api\service\mini;

use app\api\model\User;
use app\api\model\UserFeeling;
use app\lib\seal\Factory;
use app\lib\seal\http\Curl;
use app\lib\seal\http\Response;
use think\facade\Request;

class Login
{
    private $code;
    const APP_ID = 'wx5ee31374b90011a9';
    const APP_SECRET = '0f9298546de272bc44630454c71508c3';

    public function setCode($code)
    {
        $this->code = $code;
    }

    private function getOpenId()
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='. self::APP_ID .'&secret='
            . self::APP_SECRET .'&js_code='. $this->code .'&grant_type=authorization_code';

        return Curl::https($url);
    }

    /**
     * Notes:
     * Date: 2018/9/10 0010
     * Time: 下午 3:10
     * @throws
     */
    public function register($result, $userInfo)
    {
        $model = User::getInstant();
        $feeling = UserFeeling::getInstant();
        $model->register($result, $userInfo);
//      为用户生成灵感记录
        $feeling->createFeeling($model->id);
        return $model->id;
    }

    /**
     * Notes:登录
     * Date: 2018/9/10 0010
     * Time: 下午 4:02
     * @throws
     */
    public function login($userInfo)
    {
        $result = $this->getOpenId();
        $model = User::get(['openid' => $result['openid']]);
        $uid = $model->uid;

        if ($uid){
            $model->session_key = $result['session_key'];
            $model->avatar = $userInfo['avatarUrl'];
            $model->nickname = $userInfo['nickName'];
            $model->save();
        }
        else $uid = $this->register($result, $userInfo);

        $token = Request::header('token');
        $res = Factory::redis()->get($token);

        if (!$res){
            session_start();
            $token = md5(session_id().$uid.time());
            $res = Factory::redis()->set($token,$uid,3600*24*7);
            if (!$res) Response::error('token未能正确设置');
        }
        return $token;
    }
}