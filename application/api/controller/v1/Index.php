<?php
/**
 * Created by PhpStorm.
 * User=>Administrator
 * Date=>2018/6/19 0019
 * Time=>下午 2:44
 */
namespace app\api\controller\v1;

use app\api\controller\Base;
use app\lib\validate\CustomValidate;
use app\lib\seal\AesEncrypt;
use mumbaicat\makeapidoc\ApiDoc;
use think\facade\Env;


class Index extends Base
{
    protected $data = [
        [
            'date' => 'Sep 18 2018',
            'title' => '正是虾黄蟹肥时',
            'headImgSrc' => '/images/post/crab.png',
            'author' => "林白衣",
            'avatar' => '/images/avatar/1.png',
            'content' => '菊黄蟹正肥，品尝秋之味。徐志摩把“看初花的荻芦”和“到楼外楼吃蟹”并列为秋天来杭州不能错过的风雅之事；用林妹妹的话讲是“螯封嫩玉双双满，壳凸红脂块块香”；在《世说新语》里，晋毕卓更是感叹“右手持酒杯，左手持蟹螯，拍浮酒船中，便足了一生矣。”漫漫人生长路，美食与爱岂可辜负？于是作为一个吃货，突然也很想回味一下属于我的味蕾记忆。记忆中的秋蟹，是家人的味道，弥漫着浓浓的亲情。是谁来自山川湖海，却囿于昼夜，厨房与爱？ 是母亲，深思熟虑，聪明耐心。吃蟹前，总会拿出几件工具，煞有介事而乐此不疲。告诉我们螃蟹至寒，需要佐以姜茶以祛寒，在配备的米醋小碟里，亦添入姜丝与紫苏，前者驱寒后者增香。泡好菊花茶，岁月静好，我们静等。',
            'reading' => 112,
            'collection' => 96,
            'music'=> [
                'url' =>'http://isure.stream.qqmusic.qq.com/C400004AeIvh4ML0Bz.m4a?vkey=C877A7124BF2E4AD82CA5A9190397E88D916C8453CE91EF2792D2EC4BC2D5BDE324B80365445DBD756E8ED01B625DF4BDD5000A3BC911AA3&guid=7061702283&uin=0&fromtag=66',
                'title' =>"需要人陪",
                'coverImg'=>'http://y.gtimg.cn/music/photo_new/T002R150x150M000001TEc6V0kjpVC.jpg?max_age=2592000'
            ],
            'postId' => 0,
        ],
        [
            'date' => 'Sep 18 2018',
            'title' => '比利·林恩的中场故事',
            'headImgSrc' => '/images/post/bl.png',
            'author' => "迷的城",
            'avatar' => '/images/avatar/1.png',
            'content' => '一 “李安是一位绝不会重复自己的导演，本片将极富原创性李安众所瞩目的新片《比利林恩漫长的中场休息》，正式更名《半场无战事》。',
            'reading' => 112,
            'collection' => 96,
            'music'=> [
                'url' => 'http://music.163.com/song/media/outer/url?id=142604.mp3',
                'title' => "夜夜夜夜-齐秦",
                'coverImg'=> 'http://y.gtimg.cn/music/photo_new/T002R150x150M000001TEc6V0kjpVC.jpg?max_age=2592000'
            ],
            'postId' => 1,
        ]
    ];

    /**
     * Notes:
     * Date: 2018/9/7 0007
     * Time: 上午 10:52
     * @throws
     */
    public function index()
    {
        echo strlen('https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq4HZFL7WFI9V8K81YFdFQlL3KgehicQVLFoibfHW8wDHde4Hjia6xTjgYOo4j5mjgactptaEO9jA2eg/132');
//        $data = $this->data;
//        $this->success('','',$data);
    }

    /**
     * Notes:
     * Date: 2018/9/6 0006
     * Time: 上午 11:13
     * @throws
     * @route('post/read')
     */
    public function read($id = '')
    {
        (new CustomValidate())->requires('id')->goCheck();
        $data = $this->data;
        $this->success('','',$data[$id]);
    }

    public function cacheTwo(){

    }


    public function aesEncrypt(){
        var_dump((new AesEncrypt())->setKey('hello')->generateSecret());
    }

    public function validateTest($value = ''){
        $rule = '^(png|jpg)$^';
        $res = preg_match($rule,$value);
        if ($res) $this->success('1');
        $this->error('2');
    }

    public static function generateToken(){
    //        echo config('app.secure.token_salt');

    //        echo md5(uniqid(rand(1,1000000)));
    //        $randChar = getRandChar(32);
    //        echo $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
    //        $tokenSalt = config('app.secure.token_salt');
    //        return md5($randChar . $timestamp . $tokenSalt);
    }

    public function createApiDocument()
    {
        $doc = new ApiDoc('../application/api'); //参数1是代码目录
        echo $doc->make();  //生成
    }

    public function test()
    {
        echo Env::get('database.password');
    }
}