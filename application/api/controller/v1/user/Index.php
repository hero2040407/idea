<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2 0002
 * Time: 下午 5:57
 */
namespace app\api\controller\v1\user;

use app\api\controller\Base;
use app\lib\seal\Factory;
use app\lib\seal\http\Response;
use app\lib\validate\CustomValidate;
use think\facade\Request;

class Index extends Base
{

    /**
     * Notes:
     * Date: 2018/9/10 0010
     * Time: 上午 11:01
     * @param string $code
     * @throws
     */
    public function login($code = '')
    {
        (new CustomValidate())->requires('code')->goCheck();
        $result = (new GetToken())->getOpenId($code);
        Response::success($result);
    }

    /**
     * Notes:
     * Date: 2018/9/6 0006
     * Time: 下午 5:09
     * @throws
     * @route('test')
     */
    public function test()
    {
        Factory::getUser('test')->hello();
    }
    /**
     * Notes:
     * Date: 2018/9/6 0006
     * Time: 下午 4:51
     * @throws
     * @return int|void
     * @route('index')
     */
    public function index()
    {

        Factory::redis()->incr('hello');
//        filter($this->param, 'a,b,c');
//        Redis::getInstance(20)->set('hello', 'hello world');
        var_dump(Factory::redis()->get('hello'));
//        $this->success()
//        $response = Response::create(getValidParam($this->param,'a'), $this->getResponseType(), 200)->header([]);
//        (new Response(1))->success();
    }

    /**
     * Notes:
     * Date: 2018/8/22 0022
     * Time: 上午 9:15
     * @param string $id
     * @route('test')
     */
    public function outputCsv($title, $list)
    {
        $file_name = "dasai" . date("Ymd_Hi") . ".csv";
        header('Content-Disposition: attachment;filename=' . $file_name);
        $file = fopen('php://output', "a");
        fputcsv($file, $title);
        foreach ($list as $item) {
            foreach ($item as &$value){
                $value = mb_convert_encoding($value, 'GBK', 'UTF-8');
            }
            fputcsv($file, $item);
        }
        fclose($file);
    }

    /**
     * Notes:
     * Date: 2018/8/22 0022
     * Time: 上午 9:34
     * @param string $id
     * @throws
     * @route('yeah')
     */
    public function yeah($id)
    {
        $data = func_get_args();
        var_dump($data);
//        $ip = getIp();
//        $data = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
//        $address = json_decode($data,true);
//        Container::get('response')->error();
//        echo $_SERVER['HTTP_X_FORWARDED_FOR'];
//        echo $_SERVER['HTTP_CLIENT_IP'];
//        echo $_SERVER['REMOTE_ADDR'];
//        Log::record('测试日志信息','notice');
//        var_dump(123);
//        echo $data['who'];
    }


    /**
     * Notes: this is php7.0 Test
     * Date: 2018/8/22 0022
     * Time: 下午 3:51
     * @throws
     */
    public function sevenLowBoy()
    {
        echo Request::baseUrl();
    }
}
