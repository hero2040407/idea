<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 1:28
 */
namespace app\api\model;


use app\api\service\UserTokenAccess;
use app\lib\seal\http\Response;
use MongoDB\BSON\ObjectId;

class UserFeeling extends Base
{
    /**
     * Notes:
     * Date: 2018/9/29 0029
     * Time: 下午 2:29
     * @throws
     */
    public function getFeeling()
    {
        $result = $this->setMap()->value('feeling');
        return $result;
    }

    /**
     * Notes:增加灵感值
     * Date: 2018/9/29 0029
     * Time: 下午 3:22
     * @param int $count
     * @throws
     * @return null|static
     */
    public static function incFeeling($count = 1)
    {
        $uid['uid'] = UserTokenAccess::getUid();
        $model = self::get($uid);
        $model->setInc('feeling',$count);
        return $model;
    }

    public function createFeeling($uid)
    {
        $this->uid = $uid;
        $this->feeling = 0;
        $this->save();
    }
}