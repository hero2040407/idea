<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 上午 11:10
 */
namespace app\api\service\micro;

use app\api\model\User;
use app\lib\seal\Factory;
use app\lib\seal\http\Request;
use app\lib\seal\http\Response;
use app\lib\seal\Redis;
use app\lib\seal\tool\Common;
use think\Exception;

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

        return Request::https($url);
    }

    /**
     * Notes:
     * Date: 2018/9/10 0010
     * Time: 下午 3:10
     * @throws
     */
    public function register($result)
    {
        $model = new User();
        $uuid = Common::generateUniqueId();
        $model->id = $uuid;
        $model->openid = $result['openid'];
        $model->session_key = $result['session_key'];
        $model->save();
        return $uuid;
    }

    /**
     * Notes:登录
     * Date: 2018/9/10 0010
     * Time: 下午 4:02
     * @throws
     */
    public function login()
    {
        $result = $this->getOpenId();
        $model = new User();
        $uid = $model->where([
            'openid' => $result['openid']
        ])->value('id');

        if ($uid){
            $model->save(
                ['session_key' => $result['session_key']],
                ['openid' => $result['openid']]);
        }
        else $uid = $this->register($result);

        session_start();
        $token = md5(session_id().$uid.time());

        $res = Factory::redis()->set($token,$uid,3600*24*7);
        if ($res) return ['token' => $token];
        Response::error('token未能正确设置');
    }
}