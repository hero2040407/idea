<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/10 0010
 * Time: 下午 3:32
 */
namespace app\lib\seal\tool;

class Common
{
    /**
     * Notes: 生成uuid
     * Date: 2018/8/15 0015
     * Time: 上午 10:07
     * @return string
     */
    public static function generateUniqueId()
    {
        return uniqid(rand(10000,99999));
    }

    public static function encryptFile($filename, $destination)
    {
        //第一种随机字符加密
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
//        $filename = 'info.php'; //要加密的文件
        $T_k1 = str_shuffle($str); //随机密匙1
        $T_k2 = str_shuffle($str); //随机密匙2
        $vstr = file_get_contents($filename);
        $v1 = base64_encode($vstr);
        $c = strtr($v1, $T_k1, $T_k2); //根据密匙替换对应字符。
        $c = $T_k1.$T_k2.$c;
        $q1 = "O00O0O";
        $q2 = "O0O000";
        $q3 = "O0OO00";
        $q4 = "OO0O00";
        $q5 = "OO0000";
        $q6 = "O00OO0";
        $s = '$'.$q6.'=urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");$'.$q1.'=$'.$q6.'{3}.$'.$q6.'{6}.$'.$q6.'{33}.$'.$q6.'{30};$'.$q3.'=$'.$q6.'{33}.$'.$q6.'{10}.$'.$q6.'{24}.$'.$q6.'{10}.$'.$q6.'{24};$'.$q4.'=$'.$q3.'{0}.$'.$q6.'{18}.$'.$q6.'{3}.$'.$q3.'{0}.$'.$q3.'{1}.$'.$q6.'{24};$'.$q5.'=$'.$q6.'{7}.$'.$q6.'{13};$'.$q1.'.=$'.$q6.'{22}.$'.$q6.'{36}.$'.$q6.'{29}.$'.$q6.'{26}.$'.$q6.'{30}.$'.$q6.'{32}.$'.$q6.'{35}.$'.$q6.'{26}.$'.$q6.'{30};eval($'.$q1.'("'.base64_encode('$'.$q2.'="'.$c.'";eval(\'?>\'.$'.$q1.'($'.$q3.'($'.$q4.'($'.$q2.',$'.$q5.'*2),$'.$q4.'($'.$q2.',$'.$q5.',$'.$q5.'),$'.$q4.'($'.$q2.',0,$'.$q5.'))));').'"));';

        $s = '<?php '."\n".$s."\n".' ?>';
        // 生成 加密后的PHP文件
        $fpp1 = fopen($destination, 'w');
        fwrite($fpp1, $s) or die('写文件错误');
    }

    public static function getFolderFiles($source, $destination, $child = 1)
    {
        //用法：
        // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
        // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
        //参数说明：
        // $source:源目录名
        // $destination:目的目录名
        // $child:复制时，是不是包含的子目录

        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            return 0;
        }

        if(!is_dir($destination)){
            mkdir($destination,0777);
        }

        $handle = dir($source);

        while($entry = $handle->read()) {
            if(($entry != ".")&&($entry != "..")){
                if(is_dir($source."/".$entry)){
                    if($child)
                        self::getFolderFiles($source."/".$entry,$destination."/".$entry,$child);
                }
                else{
                    self::encryptFile($source."/".$entry,$destination."/".$entry);
                }
            }
        }
        return 1;
    }
}