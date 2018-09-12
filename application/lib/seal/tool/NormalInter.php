<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 下午 3:08
 */
namespace app\lib\seal\tool;

Interface NormalInter
{
    public function index();

    public function read();

    public function create();

    public function delete();

    public function save();

    public function update();

}