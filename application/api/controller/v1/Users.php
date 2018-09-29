<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 4:28
 */
namespace app\api\controller\v1;

use app\api\model\User;
use app\lib\seal\http\Response;

class Users extends WithToken
{
    /**
     * Notes:签到
     * Date: 2018/9/29 0029
     * Time: 下午 4:26
     * @throws
     */
    public function sign()
    {
        $list['feeling'] = User::getInstant()->incFeeling();
        Response::success($list);
    }
}