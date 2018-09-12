<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25 0025
 * Time: 上午 10:18
 */
namespace app\lib\validate;

/**
 * 用于在控制器自定义错误
 * Class CustomValidate
 * @package app\api\validate
 */

class CustomValidate extends BaseValidate
{
    public function requires($rule, $message = []){
        $items = explode(',',$rule);
        $rules = [];
        foreach ($items as $v){
            $rules[$v] = 'require';
        }
        $this->rule($rules);
        return $this;
    }
}