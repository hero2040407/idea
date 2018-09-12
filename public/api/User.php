<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 下午 2:59
 */
namespace app\api\controller\v1;

use app\api\controller\Base;
use app\api\service\micro\Login;
use app\lib\seal\Factory;
use app\lib\seal\tool\Common;
use app\lib\seal\http\Response;
use app\lib\validate\CustomValidate;
use think\Request;

class User extends Base
{
    /**
     * Notes:
     * Date: 2018/9/10 0010
     * Time: 上午 11:01
     * @param string $code
     * @throws
     */
    public function login($code = '')
    {
        (new CustomValidate())->requires('code')->goCheck();
        $login = (new Login());
        $login->setCode($code);
        $result = $login->login();

        Response::success($result);
    }

    public function test(Request $request)
    {
        echo $request->uid;
//        var_dump(Factory::redis()->keys('*'));
//        echo strlen(Common::generateUid());
    }
}