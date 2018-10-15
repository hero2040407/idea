<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 3:07
 */
namespace app\api\controller\v1;

use app\api\model\Idea;
use app\api\service\mini\IdeaRedis;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use app\lib\seal\tool\NormalInter;
use app\api\model\User;

class Ideas extends WithToken implements NormalInter
{
    protected $beforeActionList = [
        'userNeedToken' => ['except' => 'index,read,items']
    ];

    /**
     * Notes: idea列表
     * Date: 2018/9/11 0011
     * Time: 下午 3:36
     * @throws
     * @return int|void
     */
    public function index($title = '')
    {
        $model = Idea::getInstant();
        $model->create_time = $title;
        $model->pid = 0;
        $model->status = 24;
        $list = $model->setMap()->order('create_time desc')->paginate(10, true);
        $result = (new IdeaRedis())->viewCount($list);
        Response::success($result);
    }

    /**
     * Notes: idea个人列表
     * Date: 2018/9/11 0011
     * Time: 下午 3:36
     * @throws
     */
    public function person($type = '')
    {
        $model = Idea::getInstant();
        switch ($type){
            case 'mine':
                $model->uid = $this->uid;
                $model->pid = 0;
                break;
            case 'collect':
                $ids = (new IdeaRedis())->ideaCollection($this->uid);
                $model->id = ['in', $ids];
                break;
            default:
                break;
        }
        $list = $model->setMap()->order('create_time desc')->paginate(10, true);
        $result = (new IdeaRedis())->viewCount($list);
        Response::success($result);
    }

    /**
     * Notes:
     * Date: 2018/9/11 0011
     * Time: 下午 3:59
     * @param string $id
     * @throws
     */
    public function read($id = '')
    {
        Factory::validate('id');
        $model = Idea::getInstant();
        $result = $model->readWithUserInfo($id);
        $result->isAuthor = false;
        $result->isCollect = false;
        if ( $this->uid == $result->uid)
            $result->isAuthor = true;
        if ((new IdeaRedis())->isIdeaCollect($id, $this->uid))
            $result->isCollect = true;

        $view_count = Factory::redis()->hIncrBy('idea_view_count', $id,1);
        $result->viewCount = $view_count;
        Response::success($result);
    }

    /**
     * Notes:获取idea的子信息
     * Date: 2018/9/21 0021
     * Time: 下午 1:56
     * @throws
     */
    public function items($pid = '')
    {
        Factory::validate('pid');
        $model = Idea::getInstant();
        $result = $model->where('pid',$pid)->paginate(10,true);
        Response::success($result);
    }

    /**
     * Notes:新增一个Idea
     * Date: 2018/9/11 0011
     * Time: 下午 4:26
     * @param string $title
     * @param string $content
     * @throws
     */
    public function create($title = '', $content = '', $pid = '')
    {
        Factory::validate('title,content');
        $model = Idea::getInstant();
        $model->setId();
        $model->content = $content;
        $model->uid = $this->uid;
        $model->title = $title;
        $model->pid = $pid;
        $res = $model->save();

        if ($res){
            Factory::redis()->hIncrBy('idea_view_count', $model->id,1);
            Response::success('新增成功');
        }
        Response::error('新增失败');
    }

    public function delete($id = '')
    {
        Factory::validate('id');
        Idea::destroy($id);
        Response::success('删除成功');
    }

    public function save()
    {

    }

    public function douban()
    {
        $result = file_get_contents('http://api.douban.com/v2/movie/subject/26683290');
        var_dump($result);
    }

    /**
     * Notes:
     * Date: 2018/9/11 0011
     * Time: 下午 4:06
     * @param string $id
     * @throws
     */
    public function update($id = '', $title = '', $content = '')
    {
        Factory::validate('id');
        $model = Idea::get($id);
        $model->title = $title;
        $model->content = $content;
        $model->save();
        Response::success('修改成功');
    }

    /**
     * Note: 点击收藏
     * Data:11:55
     * @throws
     */
    public function collect($id = '')
    {
        Factory::validate('id');
        $title = (new IdeaRedis())->ideaCollect($id, $this->uid);
        Response::success($title);
    }

    /**
     * 用户给文章添加灵感值
     * @url ideas/incFeeling/:id
     * @method GET
     * Date: 2018/9/29 0029
     * Time: 下午 4:06
     * @throws
     */
    public function incFeeling($id = '')
    {
        Factory::validate('id');
        User::decFeeling();
        $list = Idea::incFeeling($id);
        Response::success($list);
    }
}