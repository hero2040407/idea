<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12 0012
 * Time: 上午 10:46
 */

/**
 * Notes: 排除数组中不需要的字段
 * Date: 2018/6/27 0027
 * Time: 下午 2:12
 * @param $array
 * @param $data
 */
function exceptField($data ,$string)
{
    $array = explode(',' , $string);
    foreach ($array as $v) {
        $rule[$v] = '';
    }
    $data = array_diff_key($data , $rule);
    return $data;
}

/**
 * Notes: 获取数组中设置了的数据
 * Date: 2018/6/27 0027
 * Time: 下午 2:20
 * @param $param  //传入的参数数组
 * @param $string //想要的字段
 * @return array 返回数组
 */
function getValidParam($param ,$string)
{
    $data = [];
    $array = explode(',' , $string);
    foreach ($array as $v){
        if (isset($param[$v])) $data[$v] = $param[$v];
    }
    return $data;
}

/**
 * Notes: 获取一个\w的字符
 * Date: 2018/8/15 0015
 * Time: 上午 9:38
 * @param $length
 * @return null|string
 */
function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;
    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}

