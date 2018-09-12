<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 上午 9:47
 */
namespace app\http\middleware;

use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use think\facade\Request;

class GetUserInfo
{
    public function handle($request, \Closure $next)
    {
//        if ( == 'think') {
//            return redirect('index/think');
//        }
//        echo $request->param('name');
        $token = $request->header('token');
        $uid = Factory::redis()->get($token);
        if (!$uid) (new Response(40001,'token已过期,请重新登录'))->fail();
        $request->uid = $uid;
        return $next($request);
    }
}