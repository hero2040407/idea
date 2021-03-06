<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/19 0019
 * Time: 下午 3:46
 */
namespace app\api\controller\v1;

use app\api\controller\Base;
use app\lib\exception\ParameterException;
use GatewayClient\Gateway;

const SYSTEM_MESSAGE = 10000;
/**
 * 即时通讯业务
 * Class Worker
 * @package app\api\controller\v1
 */
class Worker extends Base
{

//    public function initialize()
//    {
//        parent::initialize(); // TODO: Change the autogenerated stub
//        Gateway::$registerAddress = '127.0.0.1:1238';
//    }

    public function bind($client_id = '',$uid = '')
    {
        Gateway::bindUid($client_id , $uid);
        $this->success('绑定成功');
    }

    public function sendToClient($uid = '',$message = '')
    {
        $array = [
            'message' => $message,
            'type' => 'message',
        ];
        $message = json_encode($array);
        Gateway::sendToUid($uid , $message);
        $this->success($message);
        $this->success($message);
    }

    /**
     * Notes:
     * Date: 2018/8/28 0028
     * Time: 下午 4:01
     * @route('insert')
     */
    public function insert()
    {
        echo microtime().'</br>';
        $arr = generateRandomArray(1000);
        var_dump(insertSort($arr));
        echo microtime();
    }


    public function quick()
    {
        echo microtime().'</br>';
        $arr = generateRandomArray(50000);
        quickSort($arr);
        echo microtime();
    }


    public function hello($name = '')
    {
        var_dump(boolval($name));
        exit();
        if ($name) echo '这个不为空';
        else echo 'name 为空';
    }
}

