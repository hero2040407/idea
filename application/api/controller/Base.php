<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/19 0019
 * Time: 下午 2:53
 */

namespace app\api\controller;

use app\lib\seal\http\Response;
use think\Controller;
use think\Request;

class Base extends Controller
{

    /**
     * 添加数据
     * @url /post
     * @method POST
     * @param string $name 姓名
     * @param string $age 年龄
     * @return int $code 状态码
     */
    public function index()
    {
        echo 'this is base';
    }

    /**
     * Notes:
     * Date: 2018/8/25 0025
     * Time: 下午 3:34
     * @throws
     */
    public function _empty()
    {
        $this->error('此路由不存在');
    }


}