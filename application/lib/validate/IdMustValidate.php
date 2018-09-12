<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5 0005
 * Time: 下午 4:31
 */

namespace app\lib\validate;


class IdMustValidate extends BaseValidate
{
    public function __construct(array $rules = [], array $message = [], array $field = [])
    {
        parent::__construct($rules, $message, $field);
    }
    protected $rule = [
        'id' => 'require',
    ];
}