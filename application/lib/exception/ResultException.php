<?php
/**
 * Created by PhpStorm.
 * User: 七月
 * Date: 2017/2/12
 * Time: 18:29
 */

namespace app\lib\exception;

/**
 * Class ParameterException
 * 通用参数类异常错误
 */
class ResultException extends BaseException
{
    public $errorCode = 200;
    public $code = 0;
    public $msg = "invalid parameters";
}