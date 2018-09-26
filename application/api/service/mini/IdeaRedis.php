<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/9/24
 * Time: 12:13
 */
namespace app\api\service\mini;


use app\lib\seal\http\Response;
use app\lib\seal\Redis;

class IdeaRedis extends Redis
{

    /**
     * Note:查看人数
     * Data:13:55
     * @param $list
     * @return mixed
     * @throws
     */
    public function viewCount($list)
    {
        foreach ($list as &$item){
            $count = $this->hGet('idea_view_count',$item['id']);
            $item['viewCount'] = $count ? $count : 0;
        }
        return $list;
    }

    /**
     * Note:收藏
     * Data:13:55
     * @param $uid
     * @return mixed
     * @throws
     */
    public function ideaCollection($uid)
    {
        $collection = $this->hGet('idea_person_collection', $uid);
        return json_decode($collection, true);
    }

    /**
     * Note:是否收藏
     * Data:13:56
     * @param $id
     * @param $uid
     * @return bool
     * @throws
     */
    public function isIdeaCollect($id, $uid)
    {
        $collection = $this->hGet('idea_person_collection', $uid);
        $collection = json_decode($collection, true);
        if (is_array($collection) && in_array($id, $collection)){
            return true;
        }

        return false;
    }

    /**
     * Note:收藏和取消收藏
     * Data:13:31
     * @param $id
     * @param $uid
     * @return bool
     * @throws
     */
    public function ideaCollect($id, $uid)
    {
        $collection = $this->hGet('idea_person_collection', $uid);
        $collection = json_decode($collection, true);
        if (($res = array_search($id, (array)$collection)) !== false){
            unset($collection[$res]);
            $title = '取消收藏';
        }
        else{
            $collection[] = $id;
            $title = '收藏成功';
        }
        $array[$uid] = json_encode($collection);
        $this->hMset('idea_person_collection', $array);
        return $title;
    }
}