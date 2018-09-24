<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/9/22
 * Time: 17:03
 */
namespace app\api\model;

class Comment extends Base
{
    public function userInfo()
    {
        return $this->belongsTo('User','uid')->field('id,nickname,avatar');
    }

    /**
     * Note:
     * Data:17:36
     * @return \think\Paginator
     * @throws
     */
    public function index($foreign_id)
    {
        return self::with('userInfo')
            ->where('foreign_id',$foreign_id)->paginate(10,true);
    }
}