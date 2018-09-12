<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/19 0019
 * Time: 下午 3:06
 */
namespace workerman;

//require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use Workerman\Worker;

class Gateway extends Worker
{
  public static function instance()
  {
      return new static();
  }

  public function index()
  {
      echo 1;
  }
}