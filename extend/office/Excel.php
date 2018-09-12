<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/6 0006
 * Time: 上午 9:16
 */

namespace office;

//require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

class Excel
{
    private static $instance;


    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    /**
     * Notes:  excel下载
     * Date: 2018/7/6 0006
     * Time: 上午 9:22
     * @param $title  /第一行的标题
     * @param $data  /导出数据
     * @param $filename  /文件名称
     * @param $type  /row 横向填入数据-   column 纵向填入 |
     * @throws
     */
    public function download($title, $data, $filename = 'normal', $type = 'row')
    {
        $excel = new \PHPExcel();
        $act_sheet = $excel->setActiveSheetIndex(0);
        $act_sheet->getColumnDimension()->setAutoSize(true);
        $column_count = count($title);
        for($i = 0; $i < $column_count; $i++){
            $act_sheet->setCellValueByColumnAndRow($i , 1 , $title[$i]);
        }
        $data = json_decode(json_encode($data , true));
        switch($type)
        {
            case 'row':
                $row = 2;
                foreach ($data as $v)
                {
                    $column = 0;
                    foreach ($v as $key => $value)
                    {
                        $act_sheet->setCellValueByColumnAndRow($column , $row , $value);
                        $column++;
                    }
                    $row++;
                }
                break;
            case 'column':
                $column = 0;
                foreach ($data as $v)
                {
                    $row = 2;
                    foreach ($v as $key => $value)
                    {
                        $act_sheet->setCellValueByColumnAndRow($column , $row , $value);
                        $row++;
                    }
                    $column++;
                }
                break;
            default :
                break;
        }
        $xlsTitle = iconv('utf-8', 'gb2312', "report");//文件名称
        header('pragma:public');
        header("Content-type:application/vnd.ms-excel;charset=utf-8;name= $xlsTitle.xls");
        header("Content-Disposition:attachment;filename = $filename.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $objWriter->save('php://output');

    }
}