<?php
/**
 * Created by PhpStorm.
 * User: 七月
* Date: 2017/2/12
* Time: 19:44
*/
namespace app\lib\exception;

use think\exception\Handle;
use think\Facade\Log;
use think\Request;
use Exception;

/*
 * 重写Handle的render方法，实现自定义异常消息
 */
class ExceptionHandler extends Handle
{
    private $msg;
    private $errorCode;

    public function render(Exception $e)
     {
        if ($e instanceof BaseException)
        {
            //如果是自定义异常，则控制http状态码，不需要记录日志
            //因为这些通常是因为客户端传递参数错误或者是用户请求造成的异常
            //不应当记录日志

            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else  return parent::render($e);
        $result = [
            'code' => $this->errorCode,
            'msg'  => $this->msg,
        ];
        return json($result);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  LOG_PATH,
            'level' => ['error']
        ]);
//        Log::record($e->getTraceAsString());
        Log::record($e->getMessage(),'error');
    }
}