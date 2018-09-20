<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 4:31
 */
namespace app\api\controller\v1;

use app\api\controller\Base;
use app\lib\exception\ParameterException;
use app\lib\seal\Factory;
use think\facade\Request;

class WithToken extends Base
{
    protected $uid;

    /**
     * WithToken constructor.
     * @throws ParameterException
     */
    public function userNeedToken()
    {
        $token = Request::header('token');
        $uid = Factory::redis()->get($token);
        if (!$uid)
            throw new ParameterException([
                'msg' => 'token已经过期,请重新获取',
                'errorCode' => 40101
            ]);
        $this->uid = $uid;
    }
}