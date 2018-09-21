<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 3:18
 */
namespace app\api\model;


class Idea extends Base
{
    public function userInfo()
    {
        return $this->belongsTo('User','uid')->field('id,nickname,avatar');
    }

    public function ideaItems()
    {
        return $this->hasMany('Idea','pid');
    }

    /**
     * Notes:
     * Date: 2018/9/21 0021
     * Time: 上午 11:18
     * @param $id
     * @throws
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function readWithUserInfo($id)
    {
        return self::with('userInfo,ideaItems')->find($id);
    }
}