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
    public function index()
    {
        return $this->setMap()->with('userInfo,parent')->paginate(10,true);
    }
    
    /**
     * Notes:我的评论消息
     * Date: 2018/9/26 0026
     * Time: 上午 10:43
     * @throws
     */
    public function parent()
    {
        return $this->belongsTo('Comment','pid')->with('userInfo');
    }

    /**
     * Notes:
     * Date: 2018/9/26 0026
     * Time: 下午 12:13
     * @throws
     * @return \think\Paginator
     */
    public function myReply()
    {
        $pids = $this->setMap()->column('id');
        return self::with('parent,userInfo')->whereIn('pid',$pids)->paginate(10,true);
    }
}