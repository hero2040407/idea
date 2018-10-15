<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15 0015
 * Time: 上午 10:10
 */
namespace app\api\service\mini;

use app\api\model\User;
use app\lib\exception\ResultException;
use app\lib\seal\Factory;

class Sign
{
    public $uid;
    /**
     * Notes: 日常签到
     * Date: 2018/10/15 0015
     * Time: 上午 10:11
     * @throws
     */
    public function normal()
    {
        $redis = Factory::redis();
        $res = json_decode($redis->hGet('sign_uids', $this->uid));
        $yesterday = date("Ymd", time() - 24* 3600 );
        $today = date('Ymd', time());
        $sign_data = [
            'times' => 1,
            'date' => $today
        ];
        if ($res['date'] == $today){
            throw new ResultException([
                'msg' => '请勿重复签到'
            ]);
        }
        elseif ($res['date'] == $yesterday){
            $sign_data['times'] = $res['times'] + 1;
        }
        $redis->hset('sign_uids', $this->uid, json_encode($sign_data));
        $list['feeling'] = User::getInstant()->incFeeling();
        return $list;
    }
}