<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 1:18
 */
namespace app\api\controller\v1;

use app\api\model\UserFeeling;
use app\lib\seal\http\Response;
use app\lib\seal\tool\NormalInter;

class Feelings extends WithToken implements NormalInter
{
    protected $beforeActionList = [
        'userNeedToken'
    ];

    /**
     * Notes:
     * Date: 2018/9/29 0029
     * Time: 下午 1:33
     * @throws
     */
    public function index()
    {

        // TODO: Implement index() method.
    }

    /**
     * Notes:
     * Date: 2018/9/29 0029
     * Time: 下午 2:26
     * @throws
     */
    public function read()
    {
        $model = UserFeeling::getInstant();
        $model->uid = $this->uid;
        $list['feeling'] = $model->getFeeling();
        Response::success($list);
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {

    }

    /**
     * Notes:签到获取灵感
     * Date: 2018/9/29 0029
     * Time: 下午 3:23
     * @throws
     */
    public function sign()
    {
        $res = UserFeeling::incFeeling();
        Response::success($res);
    }


}