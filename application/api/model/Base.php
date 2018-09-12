<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 下午 2:49
 */
namespace app\api\model;

use app\lib\seal\tool\Common;
use think\Model;
use think\model\concern\SoftDelete;

class Base extends Model
{
    use SoftDelete;

    protected static $model;
    public $autoWriteTimestamp = true;

    public function setMap()
    {
        $map = [];
        $data = $this->getData();
        foreach ($data as $key => $value){
            if (empty($value)) continue;
            $map[] = is_array($value) ? [$key,$value[0],$value[1]] : [$key,'=',$value];
        }
        return $this->where($map);
    }

    /**
     * Notes: 新增时给类加id
     * Date: 2018/9/12 0012
     * Time: 下午 4:14
     * @throws
     */
    public function setId()
    {
        $this->id = Common::generateUniqueId();
    }

    /**
     * Notes:获取类的实例
     * Date: 2018/9/12 0012
     * Time: 下午 4:13
     * @throws
     * @return static
     */
    public static function getInstant()
    {
        if (is_null(self::$model)){
            self::$model = new static();
        }
        return self::$model;
    }
}