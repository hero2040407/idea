<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/21 0021
 * Time: 上午 9:31
 */

namespace app\lib\exception;

use think\exception\Handle;
use think\facade\Log;
use think\Facade\Request;
use Exception;
class ExceptionHandle extends Handle
{
    private $msg;
    private $errorCode;
    private $code;

    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
            $this->code = $e->getCode();
        }
        else{
            return parent::render($e);
//            $this->recordErrorLog($e);
//            $this->msg = $e->getMessage();
//            $this->code = 500;
        }
        $result = [
            'code' => $this->errorCode,
            'msg'  => $this->msg,
//            'request_url' => $request = Request::url()
        ];
        return json($result, $this->code);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  =>  'File',
            'path' => '../logs/',
            'level' => ['error']
        ]);
//        Log::record($e->getTraceAsString());
        Log::record($e->getFile().$e->getLine(),'error');
    }
}