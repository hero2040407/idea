<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 4:28
 */
namespace app\api\controller\v1;

use app\api\model\Comment;
use app\api\model\Idea;
use app\api\model\User;
use app\api\service\mini\IdeaRedis;
use app\api\service\mini\Sign;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;

class Users extends WithToken
{

    protected $beforeActionList = [
        'userNeedToken'
    ];

    /**
     * 用户获取灵感值
     * @url users/getFeeling
     * @method GET
     * Date: 2018/10/15 0015
     * Time: 上午 9:51
     * @throws
     */
    public function getFeeling()
    {
        $model = User::get($this->uid);
        $list['feeling'] = $model->feeling;
        Response::success($list);
    }
    
    /**
     * 用户签到获取灵感
     * @url users/sign
     * @method GET
     * Date: 2018/9/29 0029
     * Time: 下午 4:26
     * @throws
     */
    public function sign()
    {
        $sign = new Sign();
        $sign->uid = $this->uid;
        $list = $sign->normal();
        Response::success($list);
    }

    /**
     * 用户的个人内容
     * @url users/mine
     * @method POST
     * Date: 2018/10/11 0011
     * Time: 上午 11:17
     * @throws
     */
    public function mine($status = '')
    {
        Factory::validate('is_public');
        $model = Idea::getInstant();
        $model->uid = $this->uid;
        $model->pid = 0;
        $model->status = $status;
        $list = $model->index();
        Response::success($list);
    }

    /**
     * 用户收藏的内容
     * @url users/ideas
     * @method GET
     * Date: 2018/10/11 0011
     * Time: 上午 11:23
     * @throws
     */
    public function collect()
    {
        $model = Idea::getInstant();
        $ids = (new IdeaRedis())->ideaCollection($this->uid);
        $model->id = ['in', $ids];
        $list = $model->index();
        Response::success($list);
    }

    /**
     * Note: 个人评论
     * Data:11:18
     * @throws
     */
    public function comment()
    {
        $model = Comment::getInstant();
        $model->uid = $this->uid;
        $model->pid =  0;
        $list = $model->myReply();
        Response::success($list);
    }
}