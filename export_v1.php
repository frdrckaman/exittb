<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();
//call the autoload
require 'phpspreadsheet/vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call xlsx writer class to make an xlsx file
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();
$column1 = $override->getColumn('crf01_pg01');
$column2 = $override->getColumn('crf01_pg02');
$data1 = $override->getData('crf01_pg01');
$data2 = $override->getData('crf01_pg02');
$x=1;$y=0;$z=2;//print_r($data1);
foreach ($column1 as $column){if($y > 25){$y=0;}
    if($column['Field'] == 'fid' || $column['Field'] == 'tmp' || $column['Field'] == 'id'){
        //$sheet->setCellValue($user->excelRow($x,$y).'1', $column['Field']);
        //echo $column['Field'];
    }else{
        $sheet->setCellValue($user->excelRow($x,$y).'1', $column['Field']);
        $z=2;
        foreach ($data1 as $data){//print_r($data);
            if($data['fid'] || $data['id'] || $data['tmp']){print_r($data['id']);echo ' , ';

            }else{
                $sheet->setCellValue($user->excelRow($x,$y).''.$z, $data[$column['Field']]);
                $z++;
            }
        }
        $x++;$y++;$z++;
    }
    //print_r($user->excelRow($x,$y));echo'  ;  ';
}$z=2;
foreach ($column2 as $column){if($y > 25){$y=0;}

    if($column['Field'] == 'id' || $column['Field'] == 'fid' || $column['Field'] == 'country' || $column['Field'] == 'institution' || $column['Field'] == 'facility' ||$column['Field'] == 'tbsnum' ||$column['Field'] == 'tmp'){
        //$sheet->setCellValue($user->excelRow($x,$y).'1', $column['Field']);
        //echo $column['Field'];
    }else{
        $sheet->setCellValue($user->excelRow($x,$y).'1', $column['Field']);
       // print_r($user->excelRow($x,$y));echo'  ;  ';
        //print_r($x);echo ' , ';
        $x++;$y++;

    }
    //print_r($user->excelRow(53,$y));echo'  ;  ';
}
$x=1;$y=0;
foreach ($data1 as $data){

}
print_r($user->excelRow(52,25));
//make an xlsx writer object using above spreadsheet
$writer = new Xlsx($spreadsheet);
//write the file in current directory
$writer->save('hello world.xlsx');
//redirect to the file
//echo "<meta http-equiv='refresh' content='0;url=hello world.xlsx'/>";
