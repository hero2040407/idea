<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/9/22
 * Time: 16:56
 */
namespace app\api\controller\v1;

use app\api\model\Comment;
use app\api\service\mini\IdeaRedis;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use app\lib\seal\tool\NormalInter;

class Comments extends WithToken implements NormalInter
{
    protected $beforeActionList = [
        'userNeedToken' => ['except' => 'index']
    ];
    /**
     * Note: 评论列表
     * Data:17:11
     * @param $foreign_id
     * @throws
     */
    public function index($foreign_id = '')
    {
        Factory::validate('foreign_id');
        $model = Comment::getInstant();
        $model->foreign_id = $foreign_id;
        $model->pid = 0;
        $list = $model->index();
        Response::success($list);
    }

    /**
     * Note: 个人评论
     * Data:11:18
     * @throws
     */
    public function person()
    {
        $model = Comment::getInstant();
        $model->uid = $this->uid;
        $model->pid =  0;
        $list = $model->myReply();
        Response::success($list);
    }

    public function read()
    {
        // TODO: Implement read() method.
    }

    public function create($foreign_id = '', $content = '', $pid = 0)
    {
        Factory::validate('foreign_id,content');
        $model = Comment::getInstant();
        $model->foreign_id = $foreign_id;
        $model->content = $content;
        $model->pid = $pid;
        $model->uid = $this->uid;
        $res = $model->save();
        if ($res) Response::success('评论添加成功');
        Response::error('评论添加失败');
    }

    public function delete($id = '')
    {
        Factory::validate('id');
        $res = Comment::destroy($id, true);
        if ($res) Response::success('评论删除成功');
        Response::error('评论删除失败');
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

}