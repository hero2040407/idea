<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件
use \app\lib\seal\http\Response;
/**
 * Notes:  快速排序
 * Date: 2018/6/29 0029
 * Time: 下午 2:53
 */
function quickSort($arr)
{
    $left = [];
    $right = [];
    $length = count($arr);
    if($length<=1) return $arr;

    for($i = 1;$i < $length;$i++)
    {
        //判断当前元素的大小
        if($arr[$i]<$arr[0]){
            $left[]=$arr[$i];
        }else{
            $right[]=$arr[$i];
        }
    }
    //递归调用
    $left = quickSort($left);
    $right = quickSort($right);
    //将所有的结果合并
    return array_merge($left,array($arr[0]),$right);
}

/**
 * Notes: 插入排序
 * Date: 2018/7/12 0012
 * Time: 上午 10:43
 * @param $arr
 * @return mixed
 */
function insertSort($arr){
    $length = count($arr);
    for ($i = 1;$i < $length;$i++)
    {
        for ($j = $i;$j > 0 && $arr[$j] < $arr[$j - 1];$j--)
        {
            $middle_number = $arr[$j];
            $arr[$j] = $arr[$j - 1];
            $arr[$j - 1] = $middle_number;
        }
    }
    return $arr;
}

/**
 * Notes: 过滤传入的参数
 * Date: 2018/8/23 0023
 * Time: 下午 2:06
 * @throws
 */
function filter($param, $string)
{
    $array = explode(',',$string);
    foreach ($param as $key => $value){
        if (!in_array($key, $array) && !empty($value))
            (new Response(0,$key.'是一个无效的参数'))->error();
    }
}

function generateRandomArray($n)
{
    for ($i = 0;$i < $n ;$i++)
    {
        $arr[] = rand(1,10000000);
    }
    return $arr;
}



function getIp()
{

    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(!empty($_SERVER["REMOTE_ADDR"]))
    {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else
    {
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);

    return $cip;
}