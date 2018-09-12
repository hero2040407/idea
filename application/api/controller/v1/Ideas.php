<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 3:07
 */
namespace app\api\controller\v1;

use app\api\model\Base;
use app\api\model\Idea;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use app\lib\seal\tool\NormalInter;

class Ideas extends WithToken implements NormalInter
{
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
        $list = $model->setMap()->order('create_time desc')->paginate(10);
        Response::success($list);
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
        $result = Idea::get($id);
        Response::success($result);
        // TODO: Implement read() method.
    }

    /**
     * Notes:新增一个Idea
     * Date: 2018/9/11 0011
     * Time: 下午 4:26
     * @param string $title
     * @param string $content
     * @throws
     */
    public function create($title = '', $content = '')
    {
        Factory::validate('content,title');
        $model = Idea::getInstant();

        $model->setId();
        $model->content = $content;
        $model->uid = $this->uid;
        $model->title = $title;
        $res = $model->save();

        if ($res) Response::success('新增成功');
        Response::error('新增失败');
        // TODO: Implement create() method.
    }

    public function delete($id = '')
    {
        Factory::validate('id');
        Idea::destroy($id);
        Response::success('删除成功');
        // TODO: Implement delete() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
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
//        var_dump()
        $model->title = $title;
        $model->content = 123;
        $model->save();
        Response::success('修改成功');
        // TODO: Implement update() method.
    }

}