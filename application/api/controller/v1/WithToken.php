<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 4:31
 */
namespace app\api\controller\v1;

use app\api\controller\Base;
use app\api\service\UserTokenAccess;
use app\lib\exception\ParameterException;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use think\App;
use think\facade\Request;

class WithToken extends Base
{
    protected $uid;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->uid = UserTokenAccess::getUid();
    }

    /**
     * WithToken constructor.
     * @throws ParameterException
     */
    protected function userNeedToken()
    {
        UserTokenAccess::needToken();
    }



}